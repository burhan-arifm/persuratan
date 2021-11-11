@extends('surat.saved.identitas')

@section('form-name', 'Izin Observasi')

@section('detail-form')
        <div class="row">
        <div class="col-md-4"><strong>Tujuan Observasi</strong></div>
        <div class="col-auto">
            {{ $surat->izin_observasi->lokasi_observasi }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><strong>Alamat Observasi</strong></div>
        <div class="col-auto">
            {{ $surat->izin_observasi->alamat_lokasi }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><strong>Kota/Kabupaten</strong></div>
        <div class="col-auto">
            {{ $surat->izin_observasi->kota_lokasi }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><strong>Judul/Topik/Masalah</strong></div>
        <div class="col-auto">
		    {{ $surat->izin_observasi->topik_skripsi }}
        </div>
    </div>
@endsection
