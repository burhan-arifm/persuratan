@extends('admin.sunting.identitas')

@section('page-name', 'Izin PPM')

@section('detail-form')
<input type="hidden" name="tipe_surat" value="ppm">

<div class="form-group">
	<label class="col-md-3 control-label" for="instansi_penerima">Nama Instansi/Lembaga</label>
	<div class="col-md-6">
		<input class="form-control" id="instansi_penerima" name="instansi_penerima" placeholder="" rows="5" value="{{ $surat->ppm->instansi_penerima }}">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label" for="alamat_instansi">Alamat Instansi</label>
	<div class="col-md-6">
		<textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="" rows="5">{{ $surat->ppm->alamat_instansi }}</textarea>
        <div class="form-group" style="margin-bottom: 0; margin-top: 15px;">
            <label class="col-md-4 control-label" for="kota_lokasi">Kota/Kabupaten</label>
            <div class="col-md-8">
                <input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Kota tempat instansi berada" class="form-control" value="{{ $surat->ppm->kota_lokasi }}">
            </div>
        </div>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label" for="dosen_pembimbing">Dosen Pembimbing</label>
	<div class="col-md-6">
		<input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" placeholder="" rows="5" value="{{ $surat->ppm->dosen_pembimbing }}">
	</div>
</div>
@endsection