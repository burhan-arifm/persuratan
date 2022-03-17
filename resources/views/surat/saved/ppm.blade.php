@extends('surat.saved.identitas')

@section('form-name', 'Izin PPM')

@section('detail-form')
<div class="row">
    <div class="col-md-4"><strong>Nama Instansi/Lembaga</strong></div>
    <div class="col-auto">
        {{ $surat->ppm->instansi_penerima }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Alamat Observasi</strong></div>
    <div class="col-auto">
        {{ $surat->ppm->alamat_instansi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Kota/Kabupaten</strong></div>
    <div class="col-auto">
        {{ $surat->ppm->kota_lokasi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Dosen Pembimbing</strong></div>
    <div class="col-auto">
        {{ $surat->ppm->dosen_pembimbing }}
    </div>
</div>
@endsection
