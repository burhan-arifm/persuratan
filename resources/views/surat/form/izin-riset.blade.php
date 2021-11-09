@extends('surat.form.identitas')

@section('form-name', 'Izin Riset')

@section('detail-form')
	<input type="hidden" name="tipe_surat" value="izin-riset">

	<div class="form-group">
		<label class="col-md-6" for="lokasi_riset">Nama Instansi/Tempat Penelitian</label>
		<div class="col-auto">
			<input class="form-control" id="lokasi_riset" name="lokasi_riset" placeholder="Nama Instansi Pelaksanaan Riset Ex: PT Jaya Abadi">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="alamat_lokasi">Alamat Observasi</label>
		<div class="col-auto">
			<textarea class="form-control" id="alamat_lokasi" name="alamat_lokasi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05" rows="3"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="kota_lokasi">Kota/Kabupaten</label>
		<div class="col-auto">
			<input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Kota tempat instansi berada" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="judul_skripsi">Judul/Topik/Masalah</label>
		<div class="col-auto">
			<input class="form-control" id="judul_skripsi" name="judul_skripsi" placeholder="Judul/Topik/Masalah">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="pembimbing_1">Dosen Pembimbing 1</label>
		<div class="col-auto">
			<input id="pembimbing_1" name="pembimbing_1" type="text" placeholder="Dosen Pembimbing 1" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="pembimbing_2">Dosen Pembimbing 2</label>
		<div class="col-auto">
			<input id="pembimbing_2" name="pembimbing_2" type="text" placeholder="Dosen Pembimbing 2" class="form-control">
		</div>
	</div>
@endsection
