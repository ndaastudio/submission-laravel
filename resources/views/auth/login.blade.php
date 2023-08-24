@extends('templates.auth')

@section('form')
	<form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('login') }}" method="POST">
		@csrf
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
	</form>
@endsection
