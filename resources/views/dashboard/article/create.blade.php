@extends('templates.dashboard')

@section('content')
	<form action="{{ route('article') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-6">
				<input type="text" placeholder="Judul" name="judul" autocomplete="off"
					class="form-control form-control-solid {{ $errors->has('judul') ? 'is-invalid' : '' }}" value="{{ old('judul') }}">
				@if ($errors->has('judul'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('judul') }}</div>
				@endif
			</div>
			<div class="col-md-6">
				<input type="file" placeholder="Gambar" name="gambar"
					class="form-control form-control-solid {{ $errors->has('gambar') ? 'is-invalid' : '' }}"
					value="{{ old('gambar') }}">
				@if ($errors->has('gambar'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('gambar') }}</div>
				@endif
			</div>
			<div class="col-md-3 mt-4">
				<select class="form-select form-select-solid {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
					data-control="select1" data-placeholder="-- Pilih Kategori --" data-hide-search="true" name="category_id">
					<option value="">-- Pilih Kategori --</option>
					@foreach ($categories as $category)
						<option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
					@endforeach
				</select>
				@if ($errors->has('category_id'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('category_id') }}</div>
				@endif
			</div>
			<div class="col-md-3 mt-4">
				<select id="selectTag" class="form-select form-select-solid {{ $errors->has('tag') ? 'is-invalid' : '' }}"
					data-control="select2" data-placeholder="-- Pilih Tag --" data-hide-search="true">
					<option></option>
					@foreach ($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
					@endforeach
				</select>
				<input id="tagTerpilih" type="hidden" name="tag">
				@if ($errors->has('tag'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('tag') }}</div>
				@endif
			</div>
			<div id="selectedDiv" class="col-md-6 mt-4 d-none">
				<textarea id="selectedOptions" type="text" class="form-control form-control-solid" rows="1"
				 data-kt-autosize="true" readonly></textarea>
			</div>
			<div class="col-md-12 mt-4">
				<textarea type="text"
				 class="form-control form-control-solid {{ $errors->has('deskripsi_singkat') ? 'is-invalid' : '' }}"
				 placeholder="Deskripsi Singkat" rows="5" name="deskripsi_singkat">{{ old('deskripsi_singkat') }}</textarea>
				@if ($errors->has('deskripsi_singkat'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('deskripsi_singkat') }}</div>
				@endif
			</div>
			<div class="col-md-12 mt-4">
				<textarea id="kt_docs_ckeditor_classic" placeholder="Isi Artikel" class="form-control form-control form-control-solid"
				 name="isi">{{ old('isi') }}</textarea>
				@if ($errors->has('isi'))
					<div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('isi') }}</div>
				@endif
			</div>
		</div>
		<div class="d-flex justify-content-between mt-4">
			<div></div>
			<button type="submit" class="btn btn-primary">
				Simpan
			</button>
		</div>
	</form>
@endsection

@section('js')
	<script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
	<script>
		ClassicEditor
			.create(document.querySelector('#kt_docs_ckeditor_classic'), {
				toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'indent', 'outdent',
					'mediaEmbed', '|',
					'undo',
					'redo'
				],
			})
			.then(editor => {
				console.log(editor);
			})
			.catch(error => {
				console.error(error);
			});

		const selectedOptions = [];
		$('#selectTag').change(function() {
			const selectedOptionValue = $(this).val();
			const selectedOptionText = $(this).find(`option[value="${selectedOptionValue}"]`).text();
			const option = $(this).find(`option[value="${selectedOptionValue}"]`);
			selectedOptions.push(selectedOptionValue);
			$("#selectedDiv").removeClass("d-none");
			$('#selectedOptions').val($('#selectedOptions').val() + `#${selectedOptionText} `);
			option.remove();
			$('#tagTerpilih').val(selectedOptions);
		});
	</script>
@endsection
