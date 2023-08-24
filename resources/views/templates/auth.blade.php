<html lang="en">

<head>
	<title>{{ $title }}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('media/logos/ndaastudio.png') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
		integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css">
</head>

<body data-kt-name="metronic" id="kt_body" class="app-blank">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<a href="https://github.com/ndaastudio" class="d-block d-lg-none mx-auto py-20">
				<img alt="Logo" src="{{ asset('media/logos/ndaastudio.png') }}" class="h-25px">
			</a>
			<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
				<div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
					<div class="py-20">
						@yield('form')
					</div>
				</div>
			</div>
			<div
				class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat"
				style="background-image: url({{ asset('media/auth/bg4.jpg') }})"></div>
		</div>
	</div>
	<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('js/scripts.bundle.js') }}"></script>
</body>

</html>
