@extends('admin.base')

@section('page-title', "Beranda")

@section('main')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#"><em class="fas fa-home"></em></a>
            </li>
            <li class="active">Beranda</li>
        </ol>
    </div><!--sitemap-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Beranda</h1>
        </div>
    </div><!--page header-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pengajuan Surat Terbaru
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-angle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <surat type='terbaru'></surat>
                    </div>
                </div>
            </div>
        </div>
    </div><!--tabel surat-->
@endsection