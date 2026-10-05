@extends('layouts.default', [
    'paceTop' => true,
    'appSidebarHide' => true,
    'appHeaderHide' => true,
    'appContentClass' => 'p-0'
])

@section('title', 'Admin Login')

@section('content')

{{-- Bootstrap 5 CDN (remove if already loaded in layout) --}}


<style>
    *, *::before, *::after { box-sizing: border-box; }

    body, html {
        margin: 0; padding: 0;
        font-family: 'DM Sans', sans-serif;
        background: #1a1a2e;
        min-height: 100vh;
    }

    /* PAGE WRAPPER */
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px 16px;
        background: #1a1a2e;
        position: relative;
    }

    /* dot-grid background */
    .login-page::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: radial-gradient(rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        z-index: 0;
    }

    /* CARD */
    .login-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 960px;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        min-height: 580px;
        box-shadow: 0 32px 80px rgba(0,0,0,.6);
    }

    /* LEFT BLUE PANEL */
    .lc-left {
        width: 55%;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        padding: 40px 44px;
     
    }

    .lc-left-bg {
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&q=80&auto=format') center/cover no-repeat;
        opacity: .18;
        z-index: 0;
    }

    .lc-left-overlay {
        position: absolute;
        inset: 0;
      
        z-index: 1;
    }

    .lc-left > *:not(.lc-left-bg):not(.lc-left-overlay) { position: relative; z-index: 2; }

    .lc-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: auto;
    }

    .lc-logo img {
        max-height: 30px;
        filter: brightness(0) invert(1);
    }

    .lc-logo-text {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        letter-spacing: -.3px;
    }

    .lc-body { padding-bottom: 8px; }

    .lc-watch-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(0,0,0,.32);
        border: none;
        border-radius: 50px;
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 22px 8px 8px;
        cursor: pointer;
        transition: background .2s;
        margin-bottom: 28px;
        text-decoration: none;
    }

    .lc-watch-btn:hover { background: rgba(0,0,0,.5); color: #fff; }

    .lc-play-circle {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: #fff;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .lc-play-circle i { color: #1565e8; font-size: 12px; margin-left: 2px; }

    .lc-headline {
        font-size: clamp(26px, 3vw, 36px);
        font-weight: 700;
        color: #fff;
        line-height: 1.25;
        letter-spacing: -.5px;
        margin-bottom: 12px;
    }

    .lc-subtext {
        font-size: 15px;
        color: rgba(255,255,255,.78);
        line-height: 1.65;
        margin-bottom: 0;
        max-width: 340px;
    }

    /* RIGHT DARK PANEL */
    .lc-right {
        flex: 1;
        background: #1e1e2e;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 44px 40px;
    }

    .lc-right-title {
        font-size: 26px;
        font-weight: 700;
        color: #fff;
        text-align: center;
        margin-bottom: 28px;
        letter-spacing: -.3px;
    }

    .lc-label {
        font-size: 13px;
        font-weight: 500;
        color: #a0a0c0;
        margin-bottom: 6px;
        display: block;
    }

    .lc-input {
        width: 100%;
        height: 50px;
        background: #2a2a3e;
        border: 1px solid #38385a;
        border-radius: 10px;
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        padding: 0 46px 0 16px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .lc-input:focus {
        border-color: #1565e8;
        box-shadow: 0 0 0 3px rgba(21,101,232,.22);
        background: #2e2e45;
    }

    .lc-input::placeholder { color: #55556a; }
    .lc-input.is-invalid { border-color: #e84c4c; }
    .invalid-feedback { font-size: 12px; color: #e84c4c; margin-top: 5px; }

    .lc-inp-wrap { position: relative; }

    .lc-inp-icon {
        position: absolute;
        right: 14px; top: 50%;
        transform: translateY(-50%);
        color: #55556a;
        font-size: 15px;
        cursor: pointer;
        background: none; border: none; padding: 0;
        transition: color .15s;
        line-height: 1;
    }

    .lc-inp-icon:hover { color: #1565e8; }

    .lc-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .lc-check-label {
        display: flex; align-items: center; gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: #a0a0c0;
        user-select: none;
    }

    .lc-check-label input[type="checkbox"] {
        width: 15px; height: 15px;
        accent-color: #1565e8; cursor: pointer;
    }

    .lc-forgot {
        font-size: 13px;
        color: #35417e;
        text-decoration: none;
        font-weight: 500;
    }

    .lc-forgot:hover { text-decoration: underline; color: #4d8af0; }

    .lc-btn-signin {
        width: 100%;
        height: 50px;
        background: #35417e;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: background .2s, transform .1s;
        letter-spacing: .1px;
        margin-bottom: 22px;
    }

    .lc-btn-signin:hover { background: #35417e; }
    .lc-btn-signin:active { transform: scale(.98); }

    .lc-divider {
        display: flex; align-items: center; gap: 12px;
        margin-bottom: 18px;
    }

    .lc-divider-line { flex: 1; height: 1px; background: #2e2e45; }

    .lc-divider span {
        font-size: 12px;
        color: #55556a;
        white-space: nowrap;
    }

    .lc-socials {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 22px;
    }

    .lc-social-btn {
        width: 44px; height: 44px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
        color: #fff;
        transition: opacity .2s, transform .15s;
        text-decoration: none;
    }

    .lc-social-btn:hover { opacity: .82; transform: translateY(-2px); color: #fff; }
    .lc-social-btn.fb  { background: #1877f2; }
    .lc-social-btn.tw  { background: #1da1f2; }
    .lc-social-btn.gg  { background: #ea4335; }
    .lc-social-btn.li  { background: #0a66c2; }

    .lc-signup-text {
        text-align: center;
        font-size: 13px;
        color: #55556a;
        margin: 0;
    }

    .lc-signup-text a { color: #1565e8; font-weight: 500; text-decoration: none; }
    .lc-signup-text a:hover { text-decoration: underline; }

    /* RESPONSIVE */
    @media (max-width: 767px) {
        .login-card {
            flex-direction: column;
            border-radius: 16px;
            min-height: unset;
        }

        .lc-left {
            width: 100%;
            padding: 32px 28px 36px;
            min-height: 240px;
        }

        .lc-logo { margin-bottom: 22px; }

        .lc-right {
            padding: 32px 24px 36px;
        }

        .lc-right-title { font-size: 22px; margin-bottom: 22px; }
    }

    @media (max-width: 400px) {
        .lc-right { padding: 26px 16px 30px; }
        .lc-left  { padding: 28px 20px 32px; }
    }
</style>

<div class="login-page">
    <div class="login-card">

        {{-- LEFT BLUE PANEL --}}
        <div class="lc-left">
            <div class="lc-left-bg"></div>
            <div class="lc-left-overlay"></div>

            <div class="lc-logo">
                <img
                    src="{{ asset('assets/img/logo-main.webp') }}"
                    alt="Logo"
                    onerror="this.style.display='none'"
                >
                <span class="lc-logo-text">Admin Login</span>
            </div>

            <div class="lc-body">
              

                <h1 class="lc-headline">Welcome Back to UnifyWizard</h1>
                <p class="lc-subtext">
                   Manage blogs, publish content, track engagement, and control your platform from one powerful dashboard.
                </p>
            </div>
        </div>

        {{-- RIGHT DARK PANEL --}}
        <div class="lc-right">
            <h2 class="lc-right-title">Sign In</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="lc-label" for="email">Email Address</label>
                    <div class="lc-inp-wrap">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="lc-input @error('email') is-invalid @enderror"
                            placeholder="Enter Email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        >
                        <span class="lc-inp-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="lc-label" for="password">Password</label>
                    <div class="lc-inp-wrap">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="lc-input @error('password') is-invalid @enderror"
                            placeholder="Enter Password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="lc-inp-icon" onclick="togglePw()" aria-label="Toggle password visibility">
                            <i class="fas fa-eye" id="pwEyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                {{-- Remember / Forgot --}}
                <div class="lc-meta">
                    <label class="lc-check-label">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        Remember Me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="lc-forgot">Forgot Password ?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="lc-btn-signin">
                    Sign In
                </button>

            </form>

        
        </div>{{-- /lc-right --}}
    </div>{{-- /login-card --}}
</div>{{-- /login-page --}}


<script>
    function togglePw() {
        const inp  = document.getElementById('password');
        const icon = document.getElementById('pwEyeIcon');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            inp.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

@endsection
