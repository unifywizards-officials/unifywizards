@extends('layouts.default', [
    'paceTop' => true,
    'appSidebarHide' => true,
    'appHeaderHide' => true,
    'appContentClass' => 'p-0',
])

@section('title', 'Two-Factor Authentication')

@section('content')
<style>
    body, html { margin:0; padding:0; font-family:'DM Sans', sans-serif; background:#1a1a2e; min-height:100vh; }
    .tfa-page { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px 16px; }
    .tfa-card { width:100%; max-width:460px; background:#1e1e2e; border-radius:16px; padding:36px 36px 32px; box-shadow:0 32px 80px rgba(0,0,0,.6); }
    .tfa-title { font-size:22px; font-weight:700; color:#fff; text-align:center; margin-bottom:8px; }
    .tfa-sub { font-size:13px; color:#a0a0c0; text-align:center; margin-bottom:22px; line-height:1.6; }
    .tfa-qr-wrap { background:#fff; border-radius:12px; padding:16px; display:flex; align-items:center; justify-content:center; margin-bottom:18px; }
    .tfa-qr-wrap svg { width:100%; height:auto; max-width:220px; }
    .tfa-secret { text-align:center; margin-bottom:22px; }
    .tfa-secret small { color:#a0a0c0; font-size:12px; display:block; margin-bottom:4px; }
    .tfa-secret code { color:#fff; background:#2a2a3e; padding:6px 12px; border-radius:6px; letter-spacing:2px; font-size:13px; }
    .tfa-label { font-size:13px; font-weight:500; color:#a0a0c0; margin-bottom:6px; display:block; }
    .tfa-input { width:100%; height:50px; background:#2a2a3e; border:1px solid #38385a; border-radius:10px; color:#fff; font-size:16px; padding:0 16px; outline:none; margin-bottom:14px; }
    .tfa-input.code { font-size:22px; letter-spacing:8px; text-align:center; }
    .tfa-input:focus { border-color:#1565e8; box-shadow:0 0 0 3px rgba(21,101,232,.22); }
    .tfa-btn { width:100%; height:50px; background:#35417e; color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; cursor:pointer; }
    .tfa-error { font-size:12px; color:#e84c4c; margin:-8px 0 14px; }
    .tfa-alert { background:rgba(21,101,232,.15); border:1px solid rgba(21,101,232,.35); color:#cfe0ff; font-size:13px; border-radius:10px; padding:12px 14px; margin-bottom:18px; text-align:center; }
    .tfa-back { display:block; text-align:center; margin-top:18px; font-size:13px; color:#a0a0c0; text-decoration:none; }
    .tfa-back:hover { color:#4d8af0; }
</style>

<div class="tfa-page">
    <div class="tfa-card">

        @if ($enabled)
            <div class="tfa-title">Two-Factor Authentication</div>
            <div class="tfa-alert">Two-factor authentication is enabled on your account.</div>
            <div class="tfa-sub">To disable it, confirm your password below.</div>

            <form method="POST" action="{{ route('2fa.disable') }}">
                @csrf
                <label class="tfa-label">Current Password</label>
                <input type="password" name="password" class="tfa-input" required>
                @error('password')
                    <div class="tfa-error">{{ $message }}</div>
                @enderror
                <button type="submit" class="tfa-btn" style="background:#8a2b2b;"
                        onclick="return confirm('Disable two-factor authentication?');">
                    Disable Two-Factor Authentication
                </button>
            </form>
        @else
            <div class="tfa-title">Set Up Two-Factor Authentication</div>
            <div class="tfa-sub">Scan this QR code with an authenticator app (Google Authenticator, Authy, Microsoft Authenticator), then enter the 6-digit code it shows.</div>

            <div class="tfa-qr-wrap">
                {!! $qrCodeSvg !!}
            </div>

            <div class="tfa-secret">
                <small>Can't scan? Enter this code manually:</small>
                <code>{{ $secret }}</code>
            </div>

            <form method="POST" action="{{ route('2fa.enable') }}">
                @csrf
                <label class="tfa-label">6-digit code</label>
                <input type="text" name="code" class="tfa-input code" maxlength="6" autocomplete="one-time-code" autofocus required>
                @error('code')
                    <div class="tfa-error">{{ $message }}</div>
                @enderror

                <label class="tfa-label">Confirm your password</label>
                <input type="password" name="password" class="tfa-input" required>
                @error('password')
                    <div class="tfa-error">{{ $message }}</div>
                @enderror

                <button type="submit" class="tfa-btn">Enable Two-Factor Authentication</button>
            </form>
        @endif

        <a href="{{ route('logout') }}" class="tfa-back"
           onclick="event.preventDefault(); document.getElementById('tfa-setup-logout-form').submit();">
            Sign out
        </a>
        <form id="tfa-setup-logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </div>
</div>
@endsection
