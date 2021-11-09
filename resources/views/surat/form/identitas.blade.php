@extends('surat.form.base')

@section('form')
	<div class="form-group">
		<label class="col-md-6" for="nama_mahasiswa">Nama</label>
		<div class="col-auto">
			<input id="nama" name="nama_mahasiswa" type="text" placeholder="Isi dengan nama lengkap Anda. Contoh: Asep Hidayat Ramdani" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="nim">NIM</label>
		<div class="col-auto">
			<input id="nim" name="nim" type="text" placeholder="Isi dengan Nomor Induk Mahasiswa Anda. Contoh: 1234050123" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-6" for="program_studi">Program Studi</label>
		<div class="col-auto">
			<select id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat" data-width="100%">
				<option disabled selected hidden>Pilih Program Studi Anda</option>
				@foreach($program_studi as $prodi)
					<option value="{{ $prodi->kode_prodi }}">{{ $prodi->program_studi }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="alamat">Alamat</label>
		<div class="col-auto">
			<textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat Anda tinggal sekarang" rows="3"></textarea>
		</div>
	</div>

	@yield('detail-form')
@endsection
