@php
    $appHeaderAttr = !empty($appHeaderInverse) ? ' data-bs-theme=dark' : '';
    $appHeaderMenu = !empty($appHeaderMenu) ? $appHeaderMenu : '';
    $appHeaderMegaMenu = !empty($appHeaderMegaMenu) ? $appHeaderMegaMenu : '';
    $appHeaderTopMenu = !empty($appHeaderTopMenu) ? $appHeaderTopMenu : '';
@endphp
<style>
    .w-125px {
        width: 125px !important;
    }
</style>

<!-- BEGIN #header -->
<div id="header" class="app-header" {{ $appHeaderAttr }}>
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
        @if ($appSidebarTwo)
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-end-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        @endif
        <a href="/" class="navbar-brand"> <img src="{{ asset('assets/img/logo-main.webp') }}" class="img-fluid"
                alt="logo" style="max-height: 45px;"></a>
        @if ($appHeaderMegaMenu && !$appSidebarTwo)
            <button type="button" class="navbar-mobile-toggler" data-bs-toggle="collapse" data-bs-target="#top-navbar">
                <span class="fa-stack fa-lg">
                    <i class="far fa-square fa-stack-2x"></i>
                    <i class="fa fa-cog fa-stack-1x mt-1px"></i>
                </span>
            </button>
        @endif
        @if ($appTopMenu && !$appSidebarHide && !$appSidebarTwo)
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
                <span class="fa-stack fa-lg">
                    <i class="far fa-square fa-stack-2x"></i>
                    <i class="fa fa-cog fa-stack-1x mt-1px"></i>
                </span>
            </button>
        @endif
        @if ($appTopMenu && $appSidebarHide && !$appSidebarTwo)
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        @endif
        @if (!$appSidebarHide)
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        @endif
    </div>

    @includeWhen($appHeaderMegaMenu, 'includes.component.header-mega-menu')

    <!-- BEGIN header-nav -->
    <div class="navbar-nav">
        <div class="navbar-item navbar-form">

            <a href="{{ url('create-storage-link') }}" class="btn btn-success">
                Storage Link
            </a>

        </div>
        <div class="navbar-item dropdown">
            <a href="{{ url('clear-route') }}" class="btn btn-success">
                Clear Cache
            </a>

        </div>

        @isset($appHeaderLanguageBar)
            @include('includes.component.header-language-bar')
        @endisset

        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                @if (isset(Auth::user()->profile_image))
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="" />
                @else
                    <img src="/assets/img/user/user-13.jpg" alt="" />
                @endif
                <span>
                    <span class="d-none d-md-inline">
                        @if (isset(Auth::user()->profile_image))
                            {{ Auth::user()->name }}
                        @endif
                    </span>
                    <b class="caret"></b>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">Edit Profile</a>


                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item">Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        @if ($appSidebarTwo)
            <div class="navbar-divider d-none d-md-block"></div>
            <div class="navbar-item d-none d-md-block">
                <a href="javascript:;" data-toggle="app-sidebar-end" class="navbar-link icon">
                    <i class="fa fa-th"></i>
                </a>
            </div>
        @endif
    </div>
    <!-- END header-nav -->
</div>
<!-- END #header -->
