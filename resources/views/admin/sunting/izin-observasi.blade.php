@extends('admin.sunting.identitas')

@section('form-name', 'Izin Observasi')

@section('detail-form')
    <input type="hidden" name="tipe_surat" value="izin-observasi">

    <div class="form-group">
        <label class="col-md-6" for="lokasi_observasi">Tujuan Observasi</label>
        <div class="col-auto">
            <input id="lokasi_observasi" name="lokasi_observasi" type="text" placeholder="Contoh: PT Jaya Abadi" class="form-control" data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan" data-placement="top" value="{{ $surat->izin_observasi->lokasi_observasi }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="alamat_lokasi">Alamat Observasi</label>
        <div class="col-auto">
        <textarea class="form-control" id="alamat_lokasi" name="alamat_lokasi" placeholder="Contoh:Jl.A.H Nasution No.05" rows="3" data-toggle="tooltip" title="Masukkan alamat instansi tempat pelaksanaan" data-placement="top">{{ $surat->izin_observasi->alamat_lokasi }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="kota_lokasi">Kota/Kabupaten</label>
        <div class="col-auto">
            <input id="kota_lokasi" name="kota_lokasi" type="text" placeholder="Contoh: Bandung, Kabupaten Bandung" class="form-control" data-toggle="tooltip" title="Masukkan kota instansi tempat pelaksanaan berada" data-placement="top" value="{{ $surat->izin_observasi->kota_lokasi }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="topik_skripsi">Judul/Topik/Masalah</label>
        <div class="col-auto">
		    <input class="form-control" id="topik_skripsi" name="topik_skripsi" placeholder="Contoh: Pengaruh A Terhadap B" data-toggle="tooltip" title="Masukkan judul/topik/permasalahan yang dibahas" data-placement="top" value="{{ $surat->izin_observasi->topik_skripsi }}">
        </div>
    </div>
@endsection
