@extends('layouts.default', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', 'Login Page')



@section('content')
	<!-- BEGIN login -->
	<div class="login login-v1">
		<!-- BEGIN login-container -->
		<div class="login-container">
			<!-- BEGIN login-header -->
			<div class="login-header">
				<div class="brand">
					<div class="d-flex align-items-center">
						<img src="{{ asset('assets/img/logo-main.webp') }}" class="img-fluid" alt="logo" style="max-height: 35px;">
					</div>
					<!-- <small>Bootstrap 5 Responsive Admin Template</small> -->
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			<!-- END login-header -->

			<!-- BEGIN login-body -->
			<div class="login-body">
				<!-- BEGIN login-content -->

				<div class="login-content fs-13px">

                    <form method="POST" action="{{ route('password.update') }}">

					<div class="form-floating mb-20px text-danger" role="alert">

					@if ($errors->any())


						@foreach ($errors->all() as $error)
						{{ $error }}
						@endforeach
					</ul>
					@endif
					</div>
					<div class="form-floating mb-20px">

                        @csrf
                        <div class="form-floating mb-20px">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
							<label for="emailAddress" class="d-flex align-items-center py-0">Email Address</label>
						</div>
						<div class="form-floating mb-20px">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


							<!-- <input type="email" class="form-control fs-13px h-45px" id="emailAddress" placeholder="Email Address" /> -->
							<label for="emailAddress" class="d-flex align-items-center py-0">Password</label>
						</div>
						<div class="form-floating mb-20px">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">


							<!-- <input type="password" class="form-control fs-13px h-45px" id="password" placeholder="Password" /> -->
							<label for="password" class="d-flex align-items-center py-0">Password Confirm</label>
						</div>
						<input type="hidden" value="{{$token}}" name="token">
						<div class="login-buttons">
							<button type="submit" class="btn h-45px btn-theme d-block w-100 btn-lg">Sign me in</button>
						</div>
					</form>
				</div>
				<!-- END login-content -->
			</div>
			<!-- END login-body -->
		</div>
		<!-- END login-container -->
	</div>
	<!-- END login -->
@endsection
