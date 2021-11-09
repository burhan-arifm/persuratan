@extends('surat.form.identitas')

@section('form-name', 'Izin PPM')

@section('detail-form')
	<input type="hidden" name="tipe_surat" value="ppm">

	<div class="form-group">
		<label class="col-md-6" for="instansi_penerima">Nama Instansi/Lembaga</label>
		<div class="col-auto">
			<input class="form-control" id="instansi_penerima" name="instansi_penerima" placeholder="" rows="5">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="alamat_instansi">Alamat Observasi</label>
		<div class="col-auto">
			<textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05" rows="3"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="kota_lokasi">Kota/Kabupaten</label>
		<div class="col-auto">
			<input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Kota tempat instansi berada" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="dosen_pembimbing">Dosen Pembimbing</label>
		<div class="col-auto">
			<input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" placeholder="" rows="5">
		</div>
	</div>
@endsection
