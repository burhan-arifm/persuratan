@extends('admin.sunting.identitas')

@section('page-name', 'Izin Riset')

@section('detail-form')
<input type="hidden" name="tipe_surat" value="izin-riset">

<div class="form-group">
	<label class="col-md-3 control-label" for="lokasi_riset">Nama Instansi/Tempat Penelitian</label>
	<div class="col-md-6">
		<input class="form-control" id="lokasi_riset" name="lokasi_riset" placeholder="Nama Instansi Pelaksanaan Riset Ex: PT Jaya Abadi" value="{{ $surat->izin_riset->lokasi_riset }}">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label" for="alamat_lokasi">Alamat Penelitian</label>
	<div class="col-md-6">
		<textarea class="form-control" id="alamat_lokasi" name="alamat_lokasi" placeholder="" rows="5">{{ $surat->izin_riset->alamat_lokasi }}</textarea>
            <div class="form-group" style="margin-bottom: 0; margin-top: 15px;">
                <label class="col-md-4 control-label" for="kota_lokasi">Kota/Kabupaten</label>
                <div class="col-md-8">
                    <input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Kota tempat instansi berada" class="form-control" value="{{ $surat->izin_riset->kota_lokasi }}">
                </div>
            </div>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label" for="judul_skripsi">Judul/Topik/Masalah</label>
	<div class="col-md-6">
		<input class="form-control" id="judul_skripsi" name="judul_skripsi" placeholder="Judul/Topik/Masalah" value="{{ $surat->izin_riset->judul_skripsi }}">
	</div>
</div>
											
<div class="form-group">
	<label class="col-md-3 control-label" for="pembimbing_1">Dosen Pembimbing 1</label>
	<div class="col-md-6">
		<input id="pembimbing_1" name="pembimbing_1" type="text" placeholder="Dosen Pembimbing 1" class="form-control" value="{{ $surat->izin_riset->pembimbing_1 }}">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label" for="pembimbing_2">Dosen Pembimbing 2</label>
	<div class="col-md-6">
		<input id="pembimbing_2" name="pembimbing_2" type="text" placeholder="Dosen Pembimbing 2" class="form-control" value="{{ $surat->izin_riset->pembimbing_2 }}">
	</div>
</div>
@endsection