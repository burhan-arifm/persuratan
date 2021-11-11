@extends('admin.sunting.identitas')

@section('form-name', 'Izin Job Training')

@section('detail-form')
	<input type="hidden" name="tipe_surat" value="job-training">

	<div class="form-group">
		<label class="col-md-6" for="instansi_penerima">Nama Instansi/Lembaga</label>
		<div class="col-auto">
		<input class="form-control" id="instansi_penerima" name="instansi_penerima" placeholder="PT. Jaya Abadi"  data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan" data-placement="top" value="{{ $surat->job_training->instansi_penerima }}">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="alamat_instansi">Alamat Observasi</label>
		<div class="col-auto">
		<textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Contoh: Jl.A.H Nasution No.05" rows="3" data-toggle="tooltip" title="Masukkan alamat instansi tempat pelaksanaan" data-placement="top">{{ $surat->job_training->alamat_instansi }}</textarea>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="kota_lokasi">Kota/Kabupaten</label>
		<div class="col-auto">
		<input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Contoh: Bandung, Kabupaten Bandung" class="form-control" data-toggle="tooltip" title="Masukkan kota instansi tempat pelaksanaan berada" data-placement="top" value="{{ $surat->job_training->kota_lokasi }}">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-6" for="dosen_pembimbing">Dosen Pembimbing</label>
		<div class="col-auto">
		<input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip" title="Masukkan nama dosen pembimbing beserta gelar akademisnya." data-placement="top" value="{{ $surat->job_training->dosen_pembimbing }}">
		</div>
	</div>
@endsection
