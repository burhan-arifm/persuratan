@extends('admin.sunting.base')

@section('form')
	<div class="form-group">
		<label class="col-md-6" for="nama_mahasiswa">Nama</label>
		<div class="col-auto">
			<input id="nama" name="nama_mahasiswa" type="text" placeholder="Contoh: Asep Hidayat Ramdani" class="form-control" data-toggle="tooltip" title="Isi dengan nama lengkap Anda." data-placement="top" value="{{ $surat->mahasiswa->nama }}">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="nim">NIM</label>
		<div class="col-auto">
		<input id="nim" name="nim" type="text" placeholder="Contoh: 1234050123" class="form-control" data-toggle="tooltip" title="Isi dengan Nomor Induk Mahasiswa Anda." data-placement="top" value="{{ $surat->mahasiswa->nim }}">
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-6" for="program_studi">Program Studi</label>
		<div class="col-auto">
			<select id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat" data-width="100%">
				@foreach($program_studi as $prodi)
					<option {{ $surat->mahasiswa->jurusan->kode_prodi == $prodi->kode_prodi ? 'selected ' : '' }}value="{{ $prodi->kode_prodi }}">{{ $prodi->program_studi }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="alamat">Alamat</label>
		<div class="col-auto">
		<textarea class="form-control" id="alamat" name="alamat" placeholder="Contoh: Jl.A.H Nasution No.05 Bandung" rows="3" data-toggle="tooltip" title="Masukkan alamat lengkap Anda tinggal sekarang" data-placement="top">{{ $surat->mahasiswa->alamat }}</textarea>
		</div>
	</div>

	@yield('detail-form')
@endsection
