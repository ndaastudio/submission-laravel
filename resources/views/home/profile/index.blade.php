@extends('templates.home')

@section('content')
	<div class="d-flex flex-wrap flex-sm-nowrap">
		<div class="me-7 mb-4">
			<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
				<img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('media/avatars/blank.png') }}">
				<div
					class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
				</div>
			</div>
		</div>
		<div class="flex-grow-1">
			<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
				<div class="d-flex flex-column">
					<div class="d-flex align-items-center mb-2">
						<a class="text-gray-900 fs-2 fw-bold me-1">{{ Auth::user()->nama }}</a>
					</div>
					<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
						<a class="d-flex align-items-center text-gray-400 me-5 mb-2">
							<span class="svg-icon svg-icon-4 me-1">
								<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
										fill="currentColor"></path>
									<path
										d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
										fill="currentColor"></path>
									<rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
								</svg>
							</span>
							{{ Auth::user()->role == 1 ? 'Penulis' : (Auth::user()->role == 2 ? 'Admin' : (Auth::user()->role == 0 ? 'Pembaca' : '')) }}
						</a>
						<a class="d-flex align-items-center text-gray-400 mb-2">
							<span class="svg-icon svg-icon-4 me-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
										fill="currentColor"></path>
									<path
										d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
										fill="currentColor"></path>
								</svg>
							</span>
							{{ Auth::user()->email }}
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
		<div class="card-header cursor-pointer">
			<div class="card-title m-0">
				<h3 class="fw-bold m-0">Profil Saya</h3>
			</div>
			<a href="{{ route('profile.edit') }}" class="btn btn-primary align-self-center">Edit Profil</a>
		</div>
		<div class="card-body p-9">
			<div class="row mb-7">
				<label class="col-lg-4 fw-semibold text-muted">Nama</label>
				<div class="col-lg-8">
					<span class="fw-bold fs-6 text-gray-800">{{ Auth::user()->nama }}</span>
				</div>
			</div>
			<div class="row mb-7">
				<label class="col-lg-4 fw-semibold text-muted">Email</label>
				<div class="col-lg-8">
					<span class="fw-bold fs-6 text-gray-800">{{ Auth::user()->email }}</span>
				</div>
			</div>
			<div class="row mb-7">
				<label class="col-lg-4 fw-semibold text-muted">Role</label>
				<div class="col-lg-8">
					<span
						class="fw-bold fs-6 text-gray-800">{{ Auth::user()->role == 1 ? 'Penulis' : (Auth::user()->role == 2 ? 'Admin' : (Auth::user()->role == 0 ? 'Pembaca' : '')) }}</span>
				</div>
			</div>
			<div class="row mb-7">
				<label class="col-lg-4 fw-semibold text-muted">Bio</label>
				<div class="col-lg-8">
					<span class="fw-bold fs-6 text-gray-800">{{ Auth::user()->bio ? Auth::user()->bio : '-' }}</span>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	@if (session('success'))
		<script>
			Swal.fire({
				icon: "success",
				title: "Berhasil!",
				text: "{{ session('success') }}",
				showConfirmButton: false,
				timer: 3000,
			});
		</script>
	@endif
	@if (session('error'))
		<script>
			Swal.fire({
				icon: "error",
				title: "Berhasil!",
				text: "{{ session('error') }}",
				showConfirmButton: false,
				timer: 3000,
			});
		</script>
	@endif
@endsection
