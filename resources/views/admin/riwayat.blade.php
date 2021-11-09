@extends('admin.base')

@section('title', "Daftar Pengajuan Surat")

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <surat type='semua'></surat>
                </div>
            </div>
        </div>
    </div><!--tabel surat-->
@endsection