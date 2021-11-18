@extends('admin.sunting.identitas')

@section('form-name', 'Izin PPM')

@section('detail-form')
	<input type="hidden" name="tipe_surat" value="ppm">

	<div class="form-group">
		<label for="instansi_penerima">Nama Instansi/Lembaga</label>
		<input required class="form-control" id="instansi_penerima" name="instansi_penerima" placeholder="Contoh: PT. Jaya Abadi"  data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan" data-placement="top" value="{{ $surat->ppm->instansi_penerima }}">
		<div class="invalid-feedback">
			Wajib diisi.
		</div>
	</div>

	<div class="form-group">
		<label for="alamat_instansi">Alamat Observasi</label>
		<textarea required class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Contoh: Jl.A.H Nasution No.05" rows="3" data-toggle="tooltip" title="Masukkan alamat instansi tempat pelaksanaan" data-placement="top">{{ $surat->ppm->alamat_instansi }}</textarea>
		<div class="invalid-feedback">
			Wajib diisi.
		</div>
	</div>

	<div class="form-group">
		<label for="kota_lokasi">Kota/Kabupaten</label>
		<input required id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Contoh: Bandung, Kabupaten Bandung" class="form-control" data-toggle="tooltip" title="Masukkan kota instansi tempat pelaksanaan berada" data-placement="top" value="{{ $surat->ppm->kota_lokasi }}">
		<div class="invalid-feedback">
			Wajib diisi.
		</div>
	</div>

	<div class="form-group">
		<label for="dosen_pembimbing">Dosen Pembimbing</label>
		<input required class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip" title="Masukkan nama dosen pembimbing beserta gelar akademisnya." data-placement="top" value="{{ $surat->ppm->dosen_pembimbing }}">
		<div class="invalid-feedback">
			Wajib diisi.
		</div>
	</div>
@endsection
