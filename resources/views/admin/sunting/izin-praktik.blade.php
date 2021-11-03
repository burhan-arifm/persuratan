@extends('admin.sunting.identitas')

@section('page-name', 'Izin Praktik Mata Kuliah')

@section('detail-form')
<input type="hidden" name="tipe_surat" value="izin-praktik">

<div class="form-group">
    <label class="col-md-3 control-label" for="instansi_penerima">Tujuan Observasi</label>
    <div class="col-md-6">
        <input id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Nama Tujuan Observasi Ex: PT Jaya Abadi" class="form-control" value="{{ $surat->izin_praktik->instansi_penerima }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="alamat_instansi">Alamat Observasi</label>
    <div class="col-md-6">
        <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05, Kota Bandung" rows="5">{{ $surat->izin_praktik->alamat_instansi }}</textarea>
            <div class="form-group" style="margin-bottom: 0; margin-top: 15px;">
                <label class="col-md-4 control-label" for="kota_lokasi">Kota/Kabupaten</label>
                <div class="col-md-8">
                    <input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Kota tempat instansi berada" class="form-control" value="{{ $surat->izin_praktik->kota_lokasi }}">
                </div>
            </div>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="mata_kuliah">Mata Kuliah</label>
    <div class="col-md-6">
        <input id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Mata Kuliah" class="form-control" value="{{ $surat->izin_praktik->mata_kuliah }}">
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label" for="dosen_pengampu">Dosen Pengampu</label>
    <div class="col-md-6">
        <input id="dosen_pengampu" name="dosen_pengampu" type="text" placeholder="Nama Dosen Pengampu Mata Kuliah" class="form-control" value="{{ $surat->izin_praktik->dosen_pengampu }}">
    </div>
</div>
@endsection