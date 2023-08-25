@php
	use Carbon\Carbon;
@endphp
@extends('templates.home')

@section('content')
	<div class="d-flex flex-column flex-xl-row">
		<div class="flex-lg-row-fluid me-xl-15">
			<div class="mb-17">
				<div class="mb-8">
					<div class="d-flex flex-wrap mb-6">
						<div class="me-9 my-1">
							<span class="svg-icon svg-icon-primary svg-icon-2 me-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
									<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
										fill="currentColor"></rect>
									<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
										fill="currentColor"></rect>
									<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
										fill="currentColor"></rect>
								</svg>
							</span>
							<span class="fw-bold text-gray-400">{{ Carbon::parse($article->created_at)->format('d F Y') }}</span>
						</div>
						<div class="me-9 my-1">
							<span class="fw-bold text-gray-400">{{ $article->category->nama_kategori }}</span>
						</div>
					</div>
					<a class="text-dark fs-2 fw-bold">{{ $article->judul }}<span class="fw-bold text-muted fs-5 ps-1"></a>
					<div class="overlay mt-8">
						<div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px"
							style="background-image:url('{{ asset('storage/' . $article->gambar) }}')"></div>
					</div>
				</div>
				<div class="fs-5 fw-semibold text-gray-600">
					{!! $article->isi !!}
				</div>
				<div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
					<div class="text-center flex-shrink-0 me-7 me-lg-13">
						<div class="symbol symbol-70px symbol-circle mb-2">
							<img
								src="{{ $article->user->foto ? asset('storage/' . $article->user->foto) : asset('media/avatars/blank.png') }}">
						</div>
						<div class="mb-0">
							<a class="text-gray-700 fw-bold">{{ $article->user->nama }}</a>
							<span
								class="text-gray-400 fs-7 fw-semibold d-block mt-1">{{ $article->user->role == 1 ? 'Penulis' : ($article->user->role == 2 ? 'Admin' : '') }}</span>
						</div>
					</div>
					<div class="mb-0 fs-6">
						<div class="text-muted fw-semibold lh-lg mb-2">
							{{ $article->user->bio ? $article->user->bio : 'Penulis tidak mengisi bio' }}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">
			<div class="mb-16">
				<h4 class="text-dark mb-7">Kategori</h4>
				@foreach ($categories as $category)
					<div class="d-flex flex-stack fw-semibold fs-5 text-muted mb-4">
						<a href="{{ route('article.category', ['category' => $category->id]) }}"
							class="text-muted text-hover-primary pe-2">{{ $category->nama_kategori }}</a>
					</div>
				@endforeach
			</div>
			@if (count($latestArticles) > 0)
				<div class="m-0">
					<h4 class="text-dark mb-7">Artikel Terbaru</h4>
					@foreach ($latestArticles as $latestArticle)
						<div class="d-flex flex-stack mb-7">
							<div class="symbol symbol-60px symbol-2by3 me-4">
								<div class="symbol-label" style="background-image: url('{{ asset('storage/' . $latestArticle->gambar) }}')">
								</div>
							</div>
							<div class="m-0">
								<a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ $latestArticle->judul }}</a>
								<span class="text-gray-600 fw-semibold d-block pt-1 fs-7">{{ $latestArticle->deskripsi_singkat }}</span>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
@endsection
