@extends('templates.auth')

@section('form')
	<form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('register') }}" method="POST">
		@csrf
		<div class="fv-row mb-8 fv-plugins-icon-container">
			<input type="text" placeholder="Nama" name="nama" autocomplete="off"
				class="form-control form-control-solid {{ $errors->has('nama') ? 'is-invalid' : '' }}" value="{{ old('nama') }}">
			@if ($errors->has('nama'))
				<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('nama') }}</div>
			@endif
		</div>
		<div class="fv-row mb-8 fv-plugins-icon-container">
			<input type="email" placeholder="Email" name="email" autocomplete="off"
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
		<div class="fv-row mb-7 fv-plugins-icon-container">
			<input type="password" placeholder="Konfirmasi Password" name="password_confirmation" autocomplete="off"
				class="form-control form-control-solid {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
				value="{{ old('password_confirmation') }}">
			@if ($errors->has('password_confirmation'))
				<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('password_confirmation') }}
				</div>
			@endif
		</div>
		<div class="fv-row mb-7 fv-plugins-icon-container">
			<select class="form-select form-select-solid {{ $errors->has('role') ? 'is-invalid' : '' }}" data-control="select2"
				data-placeholder="-- Pilih Role --" data-hide-search="true" name="role">
				<option></option>
				<option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Pembaca</option>
				<option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Penulis</option>
			</select>
			@if ($errors->has('role'))
				<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('role') }}</div>
			@endif
		</div>
		<div class="d-flex flex-stack py-2">
			<div class="me-2"></div>
			<div class="m-0 mb-10">
				<span class="text-gray-400 fw-bold fs-5 me-2">Sudah punya akun?</span>
				<a href="{{ route('login') }}" class="link-primary fw-bold fs-5">Login</a>
			</div>
		</div>
		<div class="d-flex flex-stack">
			<button type="submit" class="btn btn-primary me-2 flex-shrink-0">
				<span class="indicator-label">Register</span>
			</button>
		</div>
	</form>
@endsection
