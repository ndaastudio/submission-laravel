@php
	use Carbon\Carbon;
@endphp
@extends('templates.home')

@section('content')
	<div class="mb-17">
		<div class="d-flex flex-stack mb-5">
			<h3 class="text-dark">{{ $title }}</h3>
		</div>
		<div class="separator separator-dashed mb-9"></div>
		<div class="row g-10">
			@foreach ($articles as $article)
				<div class="col-md-4">
					<div class="card-xl-stretch me-md-6">
						<a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
							style="background-image:url('{{ asset('storage/' . $article->gambar) }}')"></a>
						<div class="m-0">
							<a href="{{ route('article.uid.slug', ['uid' => $article->user->uid, 'slug' => $article->slug]) }}"
								class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ $article->judul }}</a>
							<div class="fw-semibold fs-5 text-gray-600 text-dark my-4">{{ $article->deskripsi_singkat }}</div>
							<div class="fs-6 fw-bold">
								<a class="text-gray-700">{{ $article->user->nama }}</a>
								<span class="text-muted">{{ Carbon::parse($article->created_at)->format('d F Y') }}</span>
							</div>
							<div class="d-flex justify-content-between">
								<div></div>
								<span class="badge badge-light-primary fw-bold my-2">{{ $article->category->nama_kategori }}</span>
							</div>
							<p class="fw-semibold fs-5 text-gray-600 text-dark mt-4">
								@foreach ($article->tags as $tag)
									#{{ $tag->nama_tag }}
								@endforeach
							</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection
