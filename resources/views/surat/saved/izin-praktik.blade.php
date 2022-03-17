@extends('surat.saved.identitas')

@section('form-name', 'Izin Praktik Mata Kuliah')

@section('detail-form')
<div class="row">
    <div class="col-md-4"><strong>Tujuan Observasi</strong></div>
    <div class="col-auto">
        {{ $surat->izin_praktik->instansi_penerima }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Alamat Observasi</strong></div>
    <div class="col-auto">
        {{ $surat->izin_praktik->alamat_instansi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Kota/Kabupaten</strong></div>
    <div class="col-auto">
        {{ $surat->izin_praktik->kota_lokasi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Mata Kuliah</strong></div>
    <div class="col-auto">
        {{ $surat->izin_praktik->mata_kuliah }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Dosen Pengampu</strong></div>
    <div class="col-auto">
        {{ $surat->izin_praktik->dosen_pengampu }}
    </div>
</div>
@endsection
