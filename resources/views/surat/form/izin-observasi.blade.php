@extends('surat.form.identitas')

@section('form-name', 'Izin Observasi')

@section('detail-form')
<div class="form-group">
    <label for="pembimbing_studi">Dosen Pembimbing Studi</label>
    <input required id="pembimbing_studi" name="pembimbing_studi" type="text" class="form-control"
        placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip"
        title="Masukkan nama dosen pembimbing studi beserta gelar akademisnya." data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="lokasi_observasi">Tujuan Observasi</label>
    <input required id="lokasi_observasi" name="lokasi_observasi" type="text" class="form-control"
        placeholder="Contoh: PT Jaya Abadi" data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan"
        data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="alamat_lokasi">Alamat Observasi</label>
    <textarea required class="form-control" id="alamat_lokasi" name="alamat_lokasi"
        placeholder="Contoh:Jl.A.H Nasution No.05" rows="3" data-toggle="tooltip"
        title="Masukkan alamat instansi tempat pelaksanaan" data-placement="top"></textarea>
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="kota_lokasi">Kota/Kabupaten</label>
    <input required id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Contoh: Bandung, Kabupaten Bandung"
        class="form-control" data-toggle="tooltip" title="Masukkan kota instansi tempat pelaksanaan berada"
        data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="topik_skripsi">Judul/Topik/Masalah</label>
    <input required class="form-control" id="topik_skripsi" name="topik_skripsi"
        placeholder="Contoh: Pengaruh A Terhadap B" data-toggle="tooltip"
        title="Masukkan judul/topik/permasalahan yang dibahas" data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>
@endsection
