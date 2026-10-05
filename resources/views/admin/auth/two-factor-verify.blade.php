@extends('layouts.default', [
    'paceTop' => true,
    'appSidebarHide' => true,
    'appHeaderHide' => true,
    'appContentClass' => 'p-0',
])

@section('title', 'Two-Factor Verification')

@section('content')
<style>
    body, html { margin:0; padding:0; font-family:'DM Sans', sans-serif; background:#1a1a2e; min-height:100vh; }
    .tfa-page { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px 16px; }
    .tfa-card { width:100%; max-width:420px; background:#1e1e2e; border-radius:16px; padding:40px 36px; box-shadow:0 32px 80px rgba(0,0,0,.6); }
    .tfa-title { font-size:22px; font-weight:700; color:#fff; text-align:center; margin-bottom:8px; }
    .tfa-sub { font-size:13px; color:#a0a0c0; text-align:center; margin-bottom:26px; line-height:1.6; }
    .tfa-input { width:100%; height:54px; background:#2a2a3e; border:1px solid #38385a; border-radius:10px; color:#fff; font-size:22px; letter-spacing:8px; text-align:center; outline:none; }
    .tfa-input:focus { border-color:#1565e8; box-shadow:0 0 0 3px rgba(21,101,232,.22); }
    .tfa-btn { width:100%; height:50px; background:#35417e; color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; cursor:pointer; margin-top:18px; }
    .tfa-error { font-size:12px; color:#e84c4c; margin-top:8px; text-align:center; }
    .tfa-back { display:block; text-align:center; margin-top:18px; font-size:13px; color:#a0a0c0; text-decoration:none; }
    .tfa-back:hover { color:#4d8af0; }
    .tfa-remember { display:flex; align-items:center; gap:8px; margin-top:16px; }
    .tfa-remember input { width:16px; height:16px; accent-color:#1565e8; }
    .tfa-remember label { font-size:13px; color:#a0a0c0; cursor:pointer; }
</style>

<div class="tfa-page">
    <div class="tfa-card">
        <div class="tfa-title">Two-Factor Verification</div>
        <div class="tfa-sub">Enter the 6-digit code from your authenticator app, or a recovery code if you've lost access to it.</div>

        <form method="POST" action="{{ route('2fa.verify.submit') }}">
            @csrf
            <input type="text" name="code" class="tfa-input" placeholder="000000" maxlength="10" autocomplete="one-time-code" autofocus required>
            @error('code')
                <div class="tfa-error">{{ $message }}</div>
            @enderror
            <div class="tfa-remember">
                <input type="checkbox" name="remember_device" id="remember_device" value="1" checked>
                <label for="remember_device">Trust this device for 30 days</label>
            </div>
            <button type="submit" class="tfa-btn">Verify</button>
        </form>

        <a href="{{ route('logout') }}" class="tfa-back"
           onclick="event.preventDefault(); document.getElementById('tfa-logout-form').submit();">
            Sign out
        </a>
        <form id="tfa-logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </div>
</div>
@endsection
