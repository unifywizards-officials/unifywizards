<meta charset="utf-8" />
<title>Wizard Admin | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<link rel="shortcut icon" href="{{ asset('assets/img/logo-main.webp') }}" type="image/webp">
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="/assets/css/vendor.min.css" rel="stylesheet" />
<link href="/assets/css/default/app.min.css" rel="stylesheet" />
<!-- ================== END BASE CSS STYLE ================== -->

@stack('css')
