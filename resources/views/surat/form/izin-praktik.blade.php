@extends('surat.form.identitas')

@section('form-name', 'Izin Praktik Mata Kuliah')

@section('detail-form')
    <input type="hidden" name="tipe_surat" value="izin-praktik">

    <div class="form-group">
        <label class="col-md-6" for="instansi_penerima">Tujuan Observasi</label>
        <div class="col-auto">
            <input required id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Contoh: PT. Jaya Abadi" class="form-control" data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan" data-placement="top">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="alamat_instansi">Alamat Observasi</label>
        <div class="col-auto">
            <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Contoh: Jl.A.H Nasution No.05" rows="3" data-toggle="tooltip" title="Masukkan alamat instansi tempat pelaksanaan" data-placement="top"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="kota_lokasi">Kota/Kabupaten</label>
        <div class="col-auto">
            <input required id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Contoh: Bandung, Kabupaten Bandung" class="form-control" data-toggle="tooltip" title="Masukkan kota instansi tempat pelaksanaan berada" data-placement="top">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="mata_kuliah">Mata Kuliah</label>
        <div class="col-auto">
            <input required id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Contoh: Etika Jurnalisme" class="form-control" data-toggle="tooltip" title="Masukkan nama mata kuliah" data-placement="top">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="dosen_pengampu">Dosen Pengampu</label>
        <div class="col-auto">
            <input required id="dosen_pengampu" name="dosen_pengampu" type="text" class="form-control" placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip" title="Masukkan nama dosen pengampu beserta gelar akademisnya." data-placement="top">
        </div>
    </div>
@endsection
