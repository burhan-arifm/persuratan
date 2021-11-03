@extends('admin.sunting.base')

@section('page-name', 'Izin Kunjungan')

@section('components')
<input type="hidden" name="tipe_surat" value="izin-kunjungan">
<fieldset>
    <div class="form-group">
        <label class="col-md-3 control-label" for="instansi_penerima">Tujuan Kunjungan</label>
        <div class="col-md-6">
            <input id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Nama Tujuan Observasi Ex: PT Jaya Abadi" class="form-control" value="{{ $surat->izin_kunjungan->instansi_penerima }}">
        </div>
    </div>

<div class="form-group">
    <label class="col-md-3 control-label" for="alamat_instansi">Alamat Kunjungan</label>
    <div class="col-md-6">
        <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05" rows="3">{{ $surat->izin_kunjungan->instansi_penerima }}</textarea>
        <div class="form-group" style="margin-bottom: 0; margin-top: 15px;">
            <label class="col-md-4 control-label" for="kota_instansi">Kota/Kabupaten</label>
            <div class="col-md-8">
                <input id="kota_instansi" name="kota_instansi" type="text" placeholder="Kota tempat instansi berada" class="form-control" value="{{ $surat->izin_kunjungan->kota_instansi }}">
            </div>
        </div>
    </div>
</div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="mata_kuliah">Mata Kuliah</label>
        <div class="col-md-6">
            <input id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Mata Kuliah" class="form-control" value="{{ $surat->izin_kunjungan->mata_kuliah }}">
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-md-3 control-label" for="dosen_pengampu">Dosen Pengampu</label>
        <div class="col-md-6">
            <input id="dosen_pengampu" name="dosen_pengampu" type="text" placeholder="Nama Dosen Pengampu Mata Kuliah" class="form-control" value="{{ $surat->izin_kunjungan->dosen_pengampu }}">
        </div>
    </div>

	<div class="form-group">
		<label class="col-md-3 control-label" for="program_studi">Program Studi</label>
		<div class="col-md-6">
		<select id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat" data-width="100%">
			<option disabled selected hidden>Pilih Program Studi Anda</option>
			@foreach($program_studi as $prodi)
			    <option value="{{ $prodi->kode_prodi }}" {{ ( $surat->izin_kunjungan->program_studi == $prodi->kode_prodi) ? 'selected' : '' }}>{{ $prodi->program_studi }}</option>
			@endforeach
		</select>
		</div>
	</div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="semester">Semester</label>
        <div class="col-md-6">
            <input id="semester" name="semester" type="text" placeholder="Isi dengan semester yang Anda jalani. Contoh: VIII" class="form-control" value="{{ $surat->izin_kunjungan->semester }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="kelas">Kelas</label>
        <div class="col-md-6">
            <input id="kelas" name="kelas" type="text" placeholder="Kelas Mata Kuliah" class="form-control" value="{{ $surat->izin_kunjungan->kelas }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="tanggal_kunjungan">Tanggal Kunjungan</label>
        <div class="col-md-6">
            <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                <input type="text" class="form-control datepicker" name="tanggal_kunjungan"value="{{ $surat->izin_kunjungan->tanggal_kunjungan }}">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="waktu_kunjungan">Jam Kunjungan</label>
        <div class="col-md-6">
            <div class="input-group time">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                <input id="waktu_kunjungan" name="waktu_kunjungan" type="text" placeholder="Ex : 17:00 WIB" class="form-control datepicker"value="{{ $surat->izin_kunjungan->waktu_kunjungan }}">
            </div>
        </div>
    </div>
@endsection