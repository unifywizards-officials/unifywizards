<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TrustedDeviceService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Login redirect
     */
    protected $redirectTo = 'admin/home';

    /**
     * Max login attempts
     */
    protected $maxAttempts = 3;

    /**
     * Lock time in minutes
     */
    protected $decayMinutes = 5;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Username field
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Custom throttle key
     */
    protected function throttleKey()
    {
        return strtolower(request($this->username())) . '|' . request()->ip();
    }

    /**
     * Override lockout response
     */
    protected function sendLockoutResponse($request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => [
                'Too many login attempts. Please try again after ' . ceil($seconds / 60) . ' minutes.'
            ],
        ]);
    }

    /**
     * Two-factor authentication is mandatory. Send accounts that already
     * have it set up to the code challenge, and accounts that don't yet
     * have it to forced setup — neither reaches the app directly. A user
     * who already verified 2FA on this browser within the trust window
     * skips straight through instead of being re-challenged every login.
     */
    protected function authenticated($request, $user)
    {
        if ($user->two_factor_enabled) {
            if (app(TrustedDeviceService::class)->isTrusted($user, $request)) {
                session(['2fa_passed' => true]);

                return redirect()->intended($this->redirectTo);
            }

            session(['2fa_passed' => false]);

            return redirect()->route('2fa.verify');
        }

        return redirect()->route('2fa.setup');
    }
}