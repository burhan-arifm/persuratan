@extends('admin.base')

@section('title', "Beranda")

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <surat type='terbaru'></surat>
                </div>
            </div>
        </div>
    </div>
@endsection