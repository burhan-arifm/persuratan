@extends('surat.form.base')

@section('form')
<div class="form-group">
    <label for="nama_mahasiswa">Nama</label>
    <input required id="nama" name="nama_mahasiswa" type="text" placeholder="Contoh: Asep Hidayat Ramdani"
        class="form-control" data-toggle="tooltip" title="Isi dengan nama lengkap Anda." data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="nim">NIM</label>
    <input required id="nim" name="nim" type="text" placeholder="Contoh: 1234050123" class="form-control"
        data-toggle="tooltip" title="Isi dengan Nomor Induk Mahasiswa Anda." data-placement="top">
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>
<div class="form-group">
    <label for="program_studi">Program Studi</label>
    <select required id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat"
        data-width="100%">
        <option></option>
        @foreach($program_studi as $prodi)
        <option value="{{ $prodi->kode_program_studi }}">{{ $prodi->nama_program_studi }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea required class="form-control" id="alamat" name="alamat"
        placeholder="Contoh: Jl.A.H Nasution No.05 Bandung" rows="3" data-toggle="tooltip"
        title="Masukkan alamat lengkap Anda tinggal sekarang" data-placement="top"></textarea>
    <div class="invalid-feedback">
        Wajib diisi.
    </div>
</div>

@yield('detail-form')
@endsection
