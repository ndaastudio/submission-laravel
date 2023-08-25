@extends('templates.dashboard')

@section('content')
	<div class="d-flex justify-content-between mb-4">
		<div></div>
		@if (Auth::user()->role === 1)
			<a href="{{ route('article.create') }}" class="btn btn-primary">
				Tambah Artikel
			</a>
		@endif
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-rounded table-striped border gy-7 gs-7">
			<thead>
				<tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
					<th>No.</th>
					<th>Penulis</th>
					<th>Judul</th>
					<th>Kategori</th>
					<th>Tag</th>
					<th>Gambar</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@php
					$currentPage = $articles->currentPage();
					$perPage = $articles->perPage();
					$no = $currentPage * $perPage - ($perPage - 1);
				@endphp
				@foreach ($articles as $article)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $article->user->nama }}</td>
						<td>{{ $article->judul }}</td>
						<td>{{ $article->category->nama_kategori }}</td>
						<td>
							@foreach ($article->tags as $tag)
								<span class="badge badge-primary my-1">#{{ $tag->nama_tag }}</span>
							@endforeach
						</td>
						<td><img src="{{ asset('storage/' . $article->gambar) }}" width="100px"></td>
						<td class="d-flex gap-2">
							@if (Auth::user()->role === 1)
								<div>
									<a href="{{ route('article.id', ['id' => $article->id]) }}" class="btn btn-primary">Edit</a>
								</div>
							@endif
							<form action="{{ route('article.id', ['id' => $article->id]) }}" method="POST"
								id="buttonDelete{{ $article->id }}">
								@csrf
								@method('DELETE')
								<button type="button" onclick="confirmDelete({{ $article->id }})" class="btn btn-danger">Hapus</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pagination">
			<ul class="pagination">
				<li class="page-item {{ $articles->previousPageUrl() ? '' : 'disabled' }}">
					<a href="{{ $articles->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
				</li>

				@for ($i = 1; $i <= $articles->lastPage(); $i++)
					<li class="page-item {{ $i == $articles->currentPage() ? 'active' : '' }}">
						<a href="{{ $articles->url($i) }}" class="page-link">{{ $i }}</a>
					</li>
				@endfor

				<li class="page-item {{ $articles->nextPageUrl() ? '' : 'disabled' }}">
					<a href="{{ $articles->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('js')
	<script>
		function confirmDelete(id) {
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Data yang dihapus tidak dapat dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#buttonDelete' + id).submit();
				}
			})
		}
	</script>
@endsection
