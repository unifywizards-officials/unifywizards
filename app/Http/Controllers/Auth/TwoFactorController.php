<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TrustedDeviceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Challenge screen shown after password login when 2FA is enabled.
     */
       public function showVerify()
    {
        $user = Auth::user();

        // User authenticated nahi hai
        if (!$user) {
            return redirect()->route('login');
        }

        // 2FA enabled nahi hai
        if (!$user->two_factor_enabled) {
            return redirect()->intended('/admin/home');
        }

        // 2FA already passed in this session
        if (session()->get('2fa_passed', false)) {
            return redirect()->intended('/admin/home');
        }

        return view('admin.auth.two-factor-verify');
    }

      public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Remove spaces from code
        $code = preg_replace('/\s+/', '', $request->input('code'));

        /*
        |--------------------------------------------------------------------------
        | Google Authenticator Code
        |--------------------------------------------------------------------------
        */

        if (
            strlen($code) === 6 &&
            ctype_digit($code) &&
            !empty($user->two_factor_secret)
        ) {
            $google2fa = new Google2FA();

            if ($google2fa->verifyKey(
                $user->two_factor_secret,
                $code
            )) {
                // Mark 2FA as passed for current session
                session()->put('2fa_passed', true);

                // Remember this device if requested
                if ($request->boolean('remember_device')) {
                    app(TrustedDeviceService::class)
                        ->remember($user, $request);
                }

                return redirect()->intended('/admin/home');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Recovery Code
        |--------------------------------------------------------------------------
        */

        $recoveryCodes = $user->two_factor_recovery_codes ?? [];

        // If recovery codes are stored as JSON string
        if (is_string($recoveryCodes)) {
            $recoveryCodes = json_decode($recoveryCodes, true) ?? [];
        }

        if (
            is_array($recoveryCodes) &&
            in_array($code, $recoveryCodes, true)
        ) {
            // Remove used recovery code
            $recoveryCodes = array_values(
                array_diff($recoveryCodes, [$code])
            );

            $user->two_factor_recovery_codes = $recoveryCodes;
            $user->save();

            // Mark 2FA as passed
            session()->put('2fa_passed', true);

            // Remember device
            if ($request->boolean('remember_device')) {
                app(TrustedDeviceService::class)
                    ->remember($user, $request);
            }

            return redirect()
                ->intended('/admin/home')
                ->with(
                    'warning',
                    'You used a recovery code. ' .
                    count($recoveryCodes) .
                    ' remaining.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Invalid Code
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput()
            ->withErrors([
                'code' => 'Invalid authentication code.',
            ]);
    }

    /**
     * Setup screen: generate a secret + QR code, don't enable yet.
     */
    public function showSetup()
    {
        $user = Auth::user();

        if ($user->two_factor_enabled) {
            return view('admin.auth.two-factor-setup', ['enabled' => true]);
        }

        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();

        session(['2fa_setup_secret' => $secret]);

        $qrCodeSvg = $google2fa->getQRCodeInline(
            config('app.name', 'Laravel'),
            $user->email,
            $secret
        );

        return view('admin.auth.two-factor-setup', [
            'enabled' => false,
            'secret' => $secret,
            'qrCodeSvg' => $qrCodeSvg,
        ]);
    }

    /**
     * Confirm the code from the authenticator app and turn 2FA on.
     */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $secret = session('2fa_setup_secret');

        if (!$secret) {
            return back()->withErrors(['code' => 'Setup session expired, please try again.']);
        }

        $google2fa = new Google2FA();
        $code = preg_replace('/\s+/', '', $request->code);

        if (!$google2fa->verifyKey($secret, $code)) {
            return back()->withErrors(['code' => 'Invalid authentication code.']);
        }

        $recoveryCodes = collect(range(1, 8))
            ->map(fn () => Str::random(10))
            ->values()
            ->all();

        $user->two_factor_secret = $secret;
        $user->two_factor_enabled = true;
        $user->two_factor_recovery_codes = $recoveryCodes;
        $user->save();

        session()->forget('2fa_setup_secret');
        session(['2fa_passed' => true]);

        app(TrustedDeviceService::class)->remember($user, $request);

        return view('admin.auth.two-factor-recovery-codes', ['codes' => $recoveryCodes]);
    }

    /**
     * Disable 2FA for the current account (requires password confirmation).
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $user->two_factor_secret = null;
        $user->two_factor_enabled = false;
        $user->two_factor_recovery_codes = null;
        $user->save();

        $user->trustedDevices()->delete();

        return redirect()->route('2fa.setup')->with('success', 'Two-factor authentication disabled.');
    }
}
