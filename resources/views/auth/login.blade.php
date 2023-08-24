@extends('templates.auth')

@section('form')
	<form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" id="kt_sign_in_form" action="{{ route('login') }}"
		method="POST">
		@csrf
		<div class="card-body">
			<div class="text-start mb-6">
				<h1 class="text-dark mb-3 fs-3x" data-kt-translate="sign-in-title">Login</h1>
				<div class="text-gray-400 fw-semibold fs-6" data-kt-translate="general-desc">Login untuk mengakses fitur</div>
			</div>
			@if (session('success'))
				<div class="alert alert-primary d-flex align-items-center p-5">
					<i class="fa-solid fa-circle-check fs-2hx text-primary me-4"></i>
					<div class="d-flex flex-column">
						<h4 class="mb-1 text-primary">Berhasil!</h4>
						<span>{{ session('success') }}</span>
					</div>
				</div>
			@endif
			@if (session('error'))
				<div class="alert alert-danger d-flex align-items-center p-5">
					<i class="fa-solid fa-circle-exclamation fs-2hx text-danger me-4"></i>
					<div class="d-flex flex-column">
						<h4 class="mb-1 text-danger">Error!</h4>
						<span>{{ session('error') }}</span>
					</div>
				</div>
			@endif
			<div class="fv-row mb-8 fv-plugins-icon-container">
				<input type="text" placeholder="Email" name="email" autocomplete="off"
					class="form-control form-control-solid {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
				@if ($errors->has('email'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('email') }}</div>
				@endif
			</div>
			<div class="fv-row mb-7 fv-plugins-icon-container">
				<input type="password" placeholder="Password" name="password" autocomplete="off"
					class="form-control form-control-solid {{ $errors->has('password') ? 'is-invalid' : '' }}"
					value="{{ old('password') }}">
				@if ($errors->has('password'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('password') }}</div>
				@endif
			</div>
			<div class="d-flex flex-stack py-2">
				<div class="me-2"></div>
				<div class="m-0 mb-10">
					<span class="text-gray-400 fw-bold fs-5 me-2">Belum punya akun?</span>
					<a href="{{ route('register') }}" class="link-primary fw-bold fs-5">Register</a>
				</div>
			</div>
			<div class="d-flex flex-stack">
				<button type="submit" class="btn btn-primary me-2 flex-shrink-0">
					<span class="indicator-label">Login</span>
				</button>
			</div>
		</div>
	</form>
@endsection
