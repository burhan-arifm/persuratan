@extends('admin.base')

@section('title', "Daftar Pengajuan Surat")

@section('main')
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nama">Nama</label>
                                <div class="col-md-4">
                                    <input id="nama" name="nama" type="text" placeholder="Nama" class="form-control">
                                </div>
                                <label class="col-md-1 control-label" for="status">Status</label>
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option>Open</option>
                                        <option>Done</option>
                                        <option>In Progress</option>
                                        <option>Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nim">NIM</label>
                                <div class="col-md-4">
                                    <input id="nim" name="nim" type="text" placeholder="NIM" class="form-control">
                                </div>
                                <label class="col-md-1 control-label" for="tgl_surat">Tanggal</label>
                                <div class="col-md-4">
                                    <div class='input-group date'>
                                        <div class="input-group-addon">
                                            <span class="fas fa-th"></span>
                                        </div>
                                        <input placeholder="Masukan Tanggal Surat" type="text" class="form-control datepicker" name="tgl_surat">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="no_surat">Nomor Surat</label>
                                <div class="col-md-4">
                                    <input id="no_surat" name="no_surat" type="text" placeholder="Nomor Surat" class="form-control">
                                </div>
                                <label class="col-md-1 control-label" for="status">Jenis</label>
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option>S-01</option>
                                        <option>S-02</option>
                                        <option>S-03</option>
                                        <option>S-04</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-md pull-right btn-primary"><em class="fa fa-search"></em>Cari</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-md pull-left btn-danger"><em class="fa fa-recycle"></em>Reset</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!--panel filter-->
    
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