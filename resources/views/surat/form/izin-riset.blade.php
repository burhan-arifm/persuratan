@extends('surat.form.identitas')

@section('form-name', 'Izin Riset')

@section('detail-form')
<input type="hidden" name="tipe_surat" value="izin-riset">

<div class="form-group">
    <label for="lokasi_riset">Nama Instansi/Tempat Penelitian</label>
    <input required class="form-control" id="lokasi_riset" name="lokasi_riset" placeholder="Contoh: PT Jaya Abadi"
        data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan" data-placement="top">
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
    <label for="judul_skripsi">Judul/Topik/Masalah</label>
    <input required class="form-control" id="judul_skripsi" name="judul_skripsi"
        placeholder="Contoh: Pengaruh A Terhadap B" data-toggle="tooltip"
        title="Masukkan judul/topik/permasalahan yang dibahas" data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="pembimbing_1">Dosen Pembimbing 1</label>
    <input required id="pembimbing_1" name="pembimbing_1" type="text" class="form-control"
        placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip"
        title="Masukkan nama dosen pembimbing beserta gelar akademisnya." data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="pembimbing_2">Dosen Pembimbing 2</label>
    <input required id="pembimbing_2" name="pembimbing_2" type="text" class="form-control"
        placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip"
        title="Masukkan nama dosen pembimbing beserta gelar akademisnya." data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>
@endsection
