@extends('admin.sunting.base')

@section('form-name', "Izin Kunjungan")

@section('form')
    <input type="hidden" name="tipe_surat" value="izin-kunjungan">

    <div class="form-group">
        <label class="col-md-6" for="instansi_penerima">Tujuan Kunjungan</label>
        <div class="col-auto">
            <input required id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Contoh: PT Jaya Abadi" class="form-control" data-toggle="tooltip" title="Masukkan nama instansi tempat pelaksanaan" data-placement="top" value="{{ $surat->izin_kunjungan->instansi_penerima }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="alamat_instansi">Alamat Kunjungan</label>
        <div class="col-auto">
            <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Contoh: Jl.A.H Nasution No.05" rows="3" data-toggle="tooltip" title="Masukkan alamat instansi tempat pelaksanaan" data-placement="top">{{ $surat->izin_kunjungan->alamat_instansi }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4" for="kota_instansi">Kota/Kabupaten</label>
        <div class="col-auto">
            <input required id="kota_instansi" name="kota_instansi" type="text" placeholder="Contoh: Bandung, Kabupaten Bandung" class="form-control" data-toggle="tooltip" title="Masukkan kota instansi tempat pelaksanaan berada" data-placement="top" value="{{ $surat->izin_kunjungan->kota_instansi }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="mata_kuliah">Mata Kuliah</label>
        <div class="col-auto">
            <input required id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Contoh: Etika Jurnalisme" class="form-control" data-toggle="tooltip" title="Masukkan nama mata kuliah" data-placement="top" value="{{ $surat->izin_kunjungan->mata_kuliah }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="dosen_pengampu">Dosen Pengampu</label>
        <div class="col-auto">
            <input required id="dosen_pengampu" name="dosen_pengampu" type="text" class="form-control" placeholder="Contoh: Dr. Mikial Ramdan., M.Si." data-toggle="tooltip" title="Masukkan nama dosen pengampu beserta gelar akademisnya." data-placement="top" value="{{ $surat->izin_kunjungan->dosen_pengampu }}">
        </div>
    </div>

	<div class="form-group">
		<label class="col-md-6" for="program_studi">Program Studi</label>
		<div class="col-auto">
            <select id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat" data-width="100%">
                @foreach($program_studi as $prodi)
                <option {{ $surat->izin_kunjungan->jurusan->kode_program_studi == $prodi->kode_program_studi ? 'selected ' : '' }}value="{{ $prodi->kode_program_studi }}">{{ $prodi->nama_program_studi }}</option>
                @endforeach
            </select>
		</div>
	</div>

    <div class="form-group">
        <label class="col-md-6" for="semester">Semester</label>
        <div class="col-auto">
            <input required id="semester" name="semester" type="text" placeholder="Contoh: I, IV, VI" class="form-control" data-toggle="tooltip" title="Masukkan semester yang dijalani dalam angka romawi kapital." data-placement="top" value="{{ $surat->izin_kunjungan->semester }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="kelas">Kelas</label>
        <div class="col-auto">
            <input required id="kelas" name="kelas" type="text" placeholder="Contoh: A, B, C" class="form-control" data-toggle="tooltip" title="Masukkan kelas dengan huruf kapital." data-placement="top" value="{{ $surat->izin_kunjungan->kelas }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="tanggal_kunjungan">Tanggal Kunjungan</label>
        <div class="col-auto">
            <input required id="date" type="text" class="form-control datetimepicker-input" name="tanggal_kunjungan" data-toggle="datetimepicker" data-target="#date">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3" for="waktu_kunjungan">Jam</label>
        <div class="col-auto">
            <input required id="time" type="text" class="form-control datetimepicker-input" name="waktu_kunjungan" data-toggle="datetimepicker" data-target="#time">
        </div>
    </div>
@endsection

@section('additional-scripts-2')
    <script type="text/javascript">
        $(function () {
            const datetime = "{{ $surat->izin_kunjungan->tanggal_kunjungan }} {{ $surat->izin_kunjungan->waktu_kunjungan }}"
            $('#date').datetimepicker({
                defaultDate: datetime,
                locale: "id-ID",
                format: "dddd, DD MMMM YYYY"
            });
            $('#time').datetimepicker({
                defaultDate: datetime,
                locale: "id-ID",
                format: "HH:mm"
            });
        });
    </script>
@endsection