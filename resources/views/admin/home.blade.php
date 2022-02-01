@extends('admin.base')

@section('title', "Beranda")

@section('main')
    <div class="row">
        <div class="col-md-12">
            <section class="row">
                <div class="col-md-3 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Surat belum diproses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="ph-envelope-fill ph-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-md-12">
                    <section class="card">
                        <div class="card-body">
                            <surat type='terbaru'></surat>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection
