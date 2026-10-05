<?php

namespace App\Services;

use App\Models\TrustedDevice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 * "Remember this device" for 2FA — mirrors what most hosts (Hostinger
 * included) do: verify once per browser, then trust it for 30 days
 * instead of re-prompting on every login. A different browser/device
 * has no matching cookie, so it still gets the full 2FA challenge.
 */
class TrustedDeviceService
{
    protected const COOKIE_NAME = 'device_trust';
    protected const TRUST_DAYS = 30;

    public function isTrusted(User $user, Request $request): bool
    {
        $token = $request->cookie(self::COOKIE_NAME);

        if (!$token) {
            return false;
        }

        $device = TrustedDevice::where('user_id', $user->id)
            ->where('token_hash', hash('sha256', $token))
            ->where('expires_at', '>', now())
            ->first();

        if (!$device) {
            return false;
        }

        $device->update(['last_used_at' => now()]);

        return true;
    }

    public function remember(User $user, Request $request): void
    {
        $token = Str::random(64);

        TrustedDevice::create([
            'user_id' => $user->id,
            'token_hash' => hash('sha256', $token),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
            'ip_address' => $request->ip(),
            'expires_at' => now()->addDays(self::TRUST_DAYS),
            'last_used_at' => now(),
        ]);

        Cookie::queue(
            self::COOKIE_NAME,
            $token,
            self::TRUST_DAYS * 24 * 60,
            null,
            null,
            null,
            true,
            false,
            'Lax'
        );
    }
}
