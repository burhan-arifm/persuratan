@extends('surat.saved.identitas')

@section('form-name', 'Izin Riset')

@section('detail-form')
<div class="row">
    <div class="col-md-4"><strong>Nama Instansi/Tempat Penelitian</strong></div>
    <div class="col-auto">
        {{ $surat->izin_riset->lokasi_riset }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Alamat Observasi</strong></div>
    <div class="col-auto">
        {{ $surat->izin_riset->alamat_lokasi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Kota/Kabupaten</strong></div>
    <div class="col-auto">
        {{ $surat->izin_riset->kota_lokasi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Judul/Topik/Masalah</strong></div>
    <div class="col-auto">
        {{ $surat->izin_riset->judul_skripsi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Dosen Pembimbing 1</strong></div>
    <div class="col-auto">
        {{ $surat->izin_riset->pembimbing_1 }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Dosen Pembimbing 2</strong></div>
    <div class="col-auto">
        {{ $surat->izin_riset->pembimbing_2 }}
    </div>
</div>
@endsection
