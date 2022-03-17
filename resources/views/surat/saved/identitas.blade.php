@extends('surat.saved.base')

@section('form-name')
@yield('form-name')
@endsection

@section('card-body')

<div class="row">
    <div class="col-md-4"><strong>Nama</strong></div>
    <div class="col-auto">
        {{ $surat->mahasiswa->nama }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>NIM</strong></div>
    <div class="col-auto">
        {{ $surat->mahasiswa->nim }}
    </div>
</div>
<div class="row">
    <div class="col-md-4"><strong>Program Studi</strong></div>
    <div class="col-auto">
        {{ $surat->mahasiswa->jurusan->nama_program_studi }}
    </div>
</div>

<div class="row">
    <div class="col-md-4"><strong>Alamat</strong></div>
    <div class="col-auto">
        {{ $surat->mahasiswa->alamat }}
    </div>
</div>

@yield('detail-form')
@endsection
