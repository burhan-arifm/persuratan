@extends('surat.form.base')

@section('page-name', "Izin Kunjungan")

@section('main')
    <input type="hidden" name="tipe_surat" value="izin-kunjungan">
    
    <div class="form-group">
        <label class="col-md-3 control-label" for="instansi_penerima">Tujuan Kunjungan</label>
        <div class="col-md-6">
            <input id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Nama Tujuan Observasi Ex: PT Jaya Abadi" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="alamat_instansi">Alamat Kunjungan</label>
        <div class="col-md-6">
            <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05" rows="3"></textarea>
            <div class="form-group" style="margin-bottom: 0; margin-top: 15px;">
                <label class="col-md-4 control-label" for="kota_instansi">Kota/Kabupaten</label>
                <div class="col-md-8">
                    <input id="kota_instansi" name="kota_instansi" type="text" placeholder="Kota tempat instansi berada" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="mata_kuliah">Mata Kuliah</label>
        <div class="col-md-6">
            <input id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Mata Kuliah" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="dosen_pengampu">Dosen Pengampu</label>
        <div class="col-md-6">
            <input id="dosen_pengampu" name="dosen_pengampu" type="text" placeholder="Nama Dosen Pengampu Mata Kuliah" class="form-control">
        </div>
    </div>

	<div class="form-group">
		<label class="col-md-3 control-label" for="program_studi">Program Studi</label>
		<div class="col-md-6">
		<select id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat" data-width="100%">
			<option disabled selected hidden>Pilih Program Studi Anda</option>
			@foreach($program_studi as $prodi)
			<option value="{{ $prodi->kode_prodi }}">{{ $prodi->program_studi }}</option>
			@endforeach
		</select>
		</div>
	</div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="semester">Semester</label>
        <div class="col-md-6">
            <input id="semester" name="semester" type="text" placeholder="Isi dengan semester yang Anda jalani. Contoh: VIII" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="kelas">Kelas</label>
        <div class="col-md-6">
            <input id="kelas" name="kelas" type="text" placeholder="Kelas Mata Kuliah" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="tanggal_kunjungan">Tanggal</label>
        <div class="col-md-6">
            <div class="input-group date date-new">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
                <input type="text" class="form-control datepicker" name="tanggal_kunjungan">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="waktu_kunjungan">Jam</label>
        <div class="col-md-6">
            <div class="input-group time">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </div>
                <input type="text" class="form-control datepicker" name="waktu_kunjungan">
            </div>
        </div>
    </div>
@endsection