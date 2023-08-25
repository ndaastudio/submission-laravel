@php
	use Carbon\Carbon;
@endphp
@extends('templates.home')

@section('content')
	<div class="mb-17">
		<h3 class="text-dark mb-7">Artikel Terbaru</h3>
		<div class="separator separator-dashed mb-9"></div>
		@if (count($latestArticles) === 0)
			<div class="text-center">
				<h3 class="text-dark">Belum ada artikel terbaru</h3>
			</div>
		@else
			<div class="row">
				@foreach ($latestArticles as $latestArticle)
					<div class="col-md-6">
						<div class="h-100 d-flex flex-column justify-content-between pe-lg-6 mb-lg-0 mb-10">
							<div class="mb-3">
								<img class="embed-responsive-item card-rounded h-275px w-100"
									src="{{ asset('storage/' . $latestArticle->gambar) }}">
							</div>
							<div class="mb-5">
								<a href="{{ route('article.uid.slug', ['uid' => $latestArticle->user->uid, 'slug' => $latestArticle->slug]) }}"
									class="fs-2 text-dark fw-bold text-hover-primary text-dark lh-base">{{ $latestArticle->judul }}</a>
								<div class="fw-semibold fs-5 text-gray-600 text-dark mt-4">{{ $latestArticle->deskripsi_singkat }}</div>
							</div>
							<div class="d-flex flex-stack flex-wrap">
								<div class="d-flex align-items-center pe-2">
									<div class="symbol symbol-35px symbol-circle me-3">
										<img
											src="{{ $latestArticle->user->foto ? asset('storage/' . $latestArticle->user->foto) : asset('media/avatars/blank.png') }}">
									</div>
									<div class="fs-5 fw-bold">
										<a class="text-gray-700">{{ $latestArticle->user->nama }}</a>
										<span class="text-muted">{{ Carbon::parse($latestArticle->created_at)->format('d F Y') }}</span>
									</div>
								</div>
								<span class="badge badge-light-primary fw-bold my-2">{{ $latestArticle->category->nama_kategori }}</span>
							</div>
							<p class="fw-semibold fs-5 text-gray-600 text-dark mt-4">
								@foreach ($latestArticle->tags as $tag)
									#{{ $tag->nama_tag }}
								@endforeach
							</p>
						</div>
					</div>
				@endforeach
				<div class="col-md-6 justify-content-between d-flex flex-column">
					@foreach ($otherLatestArticles as $otherLatestArticle)
						<div class="ps-lg-6 mb-16 mt-md-0 mt-17">
							<div class="mb-6">
								<a
									href="{{ route('article.uid.slug', ['uid' => $otherLatestArticle->user->uid, 'slug' => $otherLatestArticle->slug]) }}"
									class="fw-bold text-dark mb-4 fs-2 lh-base text-hover-primary">{{ $otherLatestArticle->judul }}</a>
								<div class="fw-semibold fs-5 mt-4 text-gray-600 text-dark">{{ $otherLatestArticle->deskripsi_singkat }}</div>
							</div>
							<div class="d-flex flex-stack flex-wrap">
								<div class="d-flex align-items-center pe-2">
									<div class="symbol symbol-35px symbol-circle me-3">
										<img
											src="{{ $otherLatestArticle->user->foto ? asset('storage/' . $otherLatestArticle->user->foto) : asset('media/avatars/blank.png') }}">
									</div>
									<div class="fs-5 fw-bold">
										<a class="text-gray-700">{{ $otherLatestArticle->user->nama }}</a>
										<span class="text-muted">{{ Carbon::parse($otherLatestArticle->created_at)->format('d F Y') }}</span>
									</div>
								</div>
								<span class="badge badge-light-info fw-bold my-2">{{ $otherLatestArticle->category->nama_kategori }}</span>
							</div>
							<p class="fw-semibold fs-5 text-gray-600 text-dark mt-4">
								@foreach ($otherLatestArticle->tags as $tag)
									#{{ $tag->nama_tag }}
								@endforeach
							</p>
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</div>
	<div class="mb-17">
		<div class="d-flex flex-stack mb-5">
			<h3 class="text-dark">Artikel Menarik</h3>
			<a href="{{ route('article.all') }}" class="fs-6 fw-semibold link-primary">Lihat Semua Artikel</a>
		</div>
		<div class="separator separator-dashed mb-9"></div>
		@if (count($interestingArticles) === 0)
			<div class="text-center">
				<h3 class="text-dark">Belum ada artikel menarik</h3>
			</div>
		@else
			<div class="row g-10">
				@foreach ($interestingArticles as $interestingArticle)
					<div class="col-md-4">
						<div class="card-xl-stretch me-md-6">
							<a
								class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
								style="background-image:url('{{ asset('storage/' . $interestingArticle->gambar) }}')"></a>
							<div class="m-0">
								<a
									href="{{ route('article.uid.slug', ['uid' => $interestingArticle->user->uid, 'slug' => $interestingArticle->slug]) }}"
									class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ $interestingArticle->judul }}</a>
								<div class="fw-semibold fs-5 text-gray-600 text-dark my-4">{{ $interestingArticle->deskripsi_singkat }}</div>
								<div class="fs-6 fw-bold">
									<a class="text-gray-700">{{ $interestingArticle->user->nama }}</a>
									<span class="text-muted">{{ Carbon::parse($interestingArticle->created_at)->format('d F Y') }}</span>
								</div>
								<div class="d-flex justify-content-between">
									<div></div>
									<span class="badge badge-light-primary fw-bold my-2">{{ $interestingArticle->category->nama_kategori }}</span>
								</div>
								<p class="fw-semibold fs-5 text-gray-600 text-dark mt-4">
									@foreach ($interestingArticle->tags as $tag)
										#{{ $tag->nama_tag }}
									@endforeach
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif
	</div>
@endsection
