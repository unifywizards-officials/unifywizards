<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Events\Dispatcher;

class LoginHistorySubscriber
{
    public function handleLogin(Login $event): void
    {
        LoginHistory::create([
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'event' => 'login',
            'ip_address' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 512),
        ]);
    }

    public function handleLogout(Logout $event): void
    {
        if (!$event->user) {
            return;
        }

        LoginHistory::create([
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'event' => 'logout',
            'ip_address' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 512),
        ]);
    }

    public function handleFailed(Failed $event): void
    {
        LoginHistory::create([
            'user_id' => $event->user?->id,
            'email' => $event->credentials['email'] ?? null,
            'event' => 'failed',
            'ip_address' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 512),
        ]);
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class => 'handleLogin',
            Logout::class => 'handleLogout',
            Failed::class => 'handleFailed',
        ];
    }
}
