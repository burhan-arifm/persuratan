@extends('surat.form.identitas')

@section('page-name', 'Izin Observasi')

@section('detail-form')
    <input type="hidden" name="tipe_surat" value="izin-observasi">

    <div class="form-group">
        <label class="col-md-3 control-label" for="pembimbing_studi">Pembimbing Studi</label>
        <div class="col-md-6">
            <input id="pembimbing_studi" name="pembimbing_studi" type="text" placeholder="Pembimbing Studi" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="lokasi_observasi">Tujuan Observasi</label>
        <div class="col-md-6">
            <input id="lokasi_observasi" name="lokasi_observasi" type="text" placeholder="Nama Tujuan Observasi Ex: PT Jaya Abadi" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="alamat_lokasi">Alamat Observasi</label>
        <div class="col-md-6">
            <textarea class="form-control" id="alamat_lokasi" name="alamat_lokasi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05, Kota Bandung" rows="5"></textarea>
            <div class="form-group" style="margin-bottom: 0; margin-top: 15px;">
                <label class="col-md-4 control-label" for="kota_lokasi">Kota/Kabupaten</label>
                <div class="col-md-8">
                    <input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Kota tempat instansi berada" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="topik_skripsi">Judul/Topik/Masalah</label>
        <div class="col-md-6">
		<input class="form-control" id="kota_lokasi" name="topik_skripsi" placeholder="Judul/Topik/Masalah">
        </div>
    </div>
@endsection