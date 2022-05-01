@extends('surat.saved.base')

@section('form-name', "Izin Kunjungan")

@section('card-body')
<div class="row">
    <div class="col-md-4"><strong>Tujuan Kunjungan</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->instansi_penerima }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Alamat Kunjungan</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->alamat_instansi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Kota/Kabupaten</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->kota_instansi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Mata Kuliah</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->mata_kuliah }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Dosen Pengampu</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->dosen_pengampu }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Program Studi</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->jurusan->nama_program_studi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Semester</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->semester }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Kelas</strong></div>
    <div class="col-auto">
        {{ $surat->izin_kunjungan->kelas }}
    </div>
</div>

@php
$waktu_kunjungan_string = "{$surat->izin_kunjungan->tanggal_kunjungan} {$surat->izin_kunjungan->waktu_kunjungan}";
$waktu_kunjungan = new \Carbon\Carbon($waktu_kunjungan_string, config('app.timezone'));
@endphp
<div class="row">
    <div class="col-md-4"><strong>Tanggal Kunjungan</strong></div>
    <div class="col-auto">
        {{ $waktu_kunjungan->isoFormat('dddd, DD MMMM YYYY') }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Jam</strong></div>
    <div class="col-auto">
        {{ $waktu_kunjungan->isoFormat('HH:mm \\WIB') }}
    </div>
</div>
@endsection
