@extends('layouts.default', [
    'paceTop' => true,
    'appSidebarHide' => true,
    'appHeaderHide' => true,
    'appContentClass' => 'p-0',
])

@section('title', 'Save Your Recovery Codes')

@section('content')
<style>
    body, html { margin:0; padding:0; font-family:'DM Sans', sans-serif; background:#1a1a2e; min-height:100vh; }
    .tfa-page { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px 16px; }
    .tfa-card { width:100%; max-width:460px; background:#1e1e2e; border-radius:16px; padding:36px; box-shadow:0 32px 80px rgba(0,0,0,.6); }
    .tfa-title { font-size:22px; font-weight:700; color:#fff; text-align:center; margin-bottom:16px; }
    .tfa-alert { background:rgba(232,145,21,.15); border:1px solid rgba(232,145,21,.35); color:#ffe0b3; font-size:13px; border-radius:10px; padding:14px; margin-bottom:20px; line-height:1.6; }
    .tfa-codes { background:#111122; border:1px solid #2e2e45; border-radius:10px; padding:16px; margin-bottom:22px; font-family:monospace; font-size:16px; line-height:2; color:#fff; text-align:center; }
    .tfa-btn { display:block; width:100%; height:50px; background:#35417e; color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; text-align:center; line-height:50px; text-decoration:none; }
</style>

<div class="tfa-page">
    <div class="tfa-card">
        <div class="tfa-title">Save Your Recovery Codes</div>

        <div class="tfa-alert">
            Two-factor authentication is now enabled. Store these recovery codes somewhere safe —
            each one can be used <strong>once</strong> to sign in if you lose access to your authenticator app.
            This is the only time they'll be shown.
        </div>

        <div class="tfa-codes">
            @foreach ($codes as $code)
                <div>{{ $code }}</div>
            @endforeach
        </div>

        <a href="{{ route('admin.home') }}" class="tfa-btn">I've saved these codes, continue</a>
    </div>
</div>
@endsection
