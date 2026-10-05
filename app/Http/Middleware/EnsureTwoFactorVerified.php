<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorVerified
{
    /**
     * 2FA is mandatory for every admin account. A user who hasn't set
     * it up yet is forced to the setup screen; a user who has it but
     * hasn't verified a code for the current session is sent to the
     * challenge screen. Nothing else under the gate is reachable
     * until one of those is satisfied.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && !$user->two_factor_enabled) {
            return redirect()->route('2fa.setup');
        }

        if ($user && $user->two_factor_enabled && !session('2fa_passed')) {
            return redirect()->route('2fa.verify');
        }

        return $next($request);
    }
}
