<html lang="en">

<head>
	<title>{{ $title }}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('media/logos/ndaastudio_github.png') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
	<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css">
</head>

<body data-kt-name="metronic" id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
					data-kt-sticky-offset="{default: '200px', lg: '300px'}" style="animation-duration: 0.3s;">
					<div class="container-xxl d-flex flex-grow-1 flex-stack">
						<div class="d-flex align-items-center me-5">
							<a href="{{ route('home') }}">
								<img alt="Logo" src="{{ asset('media/logos/ndaastudio_github.png') }}" class="h-20px h-lg-30px">
							</a>
						</div>
						<div class="d-flex align-items-center flex-shrink-0">
							@if (!Auth::check())
								<a href="{{ route('login') }}" class="btn btn-primary">Login</a>
							@else
								@if (Auth::user()->role == 1)
									<a href="{{ route('article.create') }}" class="btn btn-primary">Buat Artikel</a>
								@endif
								<div class="d-flex align-items-center ms-3 ms-lg-4" id="kt_header_user_menu_toggle">
									<div
										class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary w-30px h-30px w-lg-40px h-lg-40px"
										data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<span class="svg-icon svg-icon-1">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
													fill="currentColor"></path>
												<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
													fill="currentColor"></rect>
											</svg>
										</span>
									</div>
									<div
										class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
										data-kt-menu="true">
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{ asset('media/avatars/blank.png') }}">
												</div>
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->nama }}<span
															class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ Auth::user()->role == 1 ? 'Penulis' : (Auth::user()->role == 2 ? 'Admin' : (Auth::user()->role == 0 ? 'Pembaca' : '')) }}</span>
													</div>
													<a class="fw-semibold text-muted fs-7">{{ Auth::user()->email }}</a>
												</div>
											</div>
										</div>
										<div class="separator my-2"></div>
										@if (Auth::user()->role !== 2)
											<div class="menu-item px-5">
												<a href="{{ route('profile') }}" class="menu-link px-5">Profil Saya</a>
											</div>
										@endif
										@if (Auth::user()->role !== 0)
											<div class="menu-item px-5">
												<a href="{{ route('article') }}" class="menu-link px-5">Dashboard</a>
											</div>
										@endif
										<div class="menu-item px-5">
											<a href="{{ route('logout') }}" class="menu-link px-5">Keluar</a>
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
				<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
					<div class="content flex-row-fluid" id="kt_content">
						<div class="card">
							<div class="card-body p-lg-16 shadow-sm">
								@yield('content')
							</div>
						</div>
					</div>
				</div>
				<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
					<div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
						<div class="text-dark order-2 order-md-1">
							<span class="text-muted fw-semibold me-1">2023©</span>
							<a href="{{ route('about') }}" class="text-gray-800 text-hover-primary">About Aprimivi
								Manda</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
					transform="rotate(90 13 6)" fill="currentColor"></rect>
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="currentColor"></path>
			</svg>
		</span>
	</div>
	<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('js/scripts.bundle.js') }}"></script>
	@yield('js')
</body>

</html>
