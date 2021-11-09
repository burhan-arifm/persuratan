@extends('surat.form.identitas')

@section('form-name', 'Izin Praktik Mata Kuliah')

@section('detail-form')
    <input type="hidden" name="tipe_surat" value="izin-praktik">

    <div class="form-group">
        <label class="col-md-6" for="instansi_penerima">Tujuan Observasi</label>
        <div class="col-auto">
            <input id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Nama Tujuan Observasi Ex: PT Jaya Abadi" class="form-control">
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
        <label class="col-md-6" for="mata_kuliah">Mata Kuliah</label>
        <div class="col-auto">
            <input id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Mata Kuliah" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="dosen_pengampu">Dosen Pengampu</label>
        <div class="col-auto">
            <input id="dosen_pengampu" name="dosen_pengampu" type="text" placeholder="Nama Dosen Pengampu Mata Kuliah" class="form-control">
        </div>
    </div>
@endsection
