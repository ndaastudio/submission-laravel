@extends('templates.dashboard')

@section('content')
	<div class="d-flex justify-content-between mb-4">
		<div></div>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
			Tambah Tag
		</button>
		<div class="modal fade" tabindex="-1" id="kt_modal_1">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="{{ route('tag') }}" method="POST">
						@csrf
						<div class="modal-header">
							<h3 class="modal-title">Tambah Tag</h3>
							<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
								<i class="fa-solid fa-x"></i>
							</div>
						</div>
						<div class="modal-body">
							<input type="text" placeholder="Nama Tag" name="nama_tag" autocomplete="off"
								class="form-control form-control-solid {{ $errors->has('nama_tag') ? 'is-invalid' : '' }}"
								value="{{ old('nama_tag') }}" required>
							@if ($errors->has('nama_tag'))
								<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('nama_tag') }}</div>
							@endif
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-rounded table-striped border gy-7 gs-7">
			<thead>
				<tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
					<th>No.</th>
					<th>Nama Tag</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@php
					$currentPage = $tags->currentPage();
					$perPage = $tags->perPage();
					$no = $currentPage * $perPage - ($perPage - 1);
				@endphp
				@foreach ($tags as $tag)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $tag->nama_tag }}</td>
						<td class="d-flex gap-2">
							<div>
								<button type="button" class="btn btn-primary" data-bs-toggle="modal"
									data-bs-target="#kt_modal_edit{{ $tag->id }}">Edit</button>
								<div class="modal fade" tabindex="-1" id="kt_modal_edit{{ $tag->id }}">
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="{{ route('tag.id', ['id' => $tag->id]) }}" method="POST">
												@csrf
												@method('PUT')
												<div class="modal-header">
													<h3 class="modal-title">Edit Tag</h3>
													<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
														<i class="fa-solid fa-x"></i>
													</div>
												</div>
												<div class="modal-body">
													<input type="text" placeholder="Nama Tag" name="nama_tag" autocomplete="off"
														class="form-control form-control-solid {{ $errors->has('nama_tag') ? 'is-invalid' : '' }}"
														value="{{ old('nama_tag', $tag->nama_tag) }}" required>
													@if ($errors->has('nama_tag'))
														<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('nama_tag') }}</div>
													@endif
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-primary">Simpan</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<form action="{{ route('tag.id', ['id' => $tag->id]) }}" method="POST" id="buttonDelete{{ $tag->id }}">
								@csrf
								@method('DELETE')
								<button type="button" onclick="confirmDelete({{ $tag->id }})" class="btn btn-danger">Hapus</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pagination">
			<ul class="pagination">
				<li class="page-item {{ $tags->previousPageUrl() ? '' : 'disabled' }}">
					<a href="{{ $tags->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
				</li>

				@for ($i = 1; $i <= $tags->lastPage(); $i++)
					<li class="page-item {{ $i == $tags->currentPage() ? 'active' : '' }}">
						<a href="{{ $tags->url($i) }}" class="page-link">{{ $i }}</a>
					</li>
				@endfor

				<li class="page-item {{ $tags->nextPageUrl() ? '' : 'disabled' }}">
					<a href="{{ $tags->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
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
