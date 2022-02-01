@extends("surat.form.layout")

@section('page-title', "Permohonan Surat Kemahasiswaan Fakultas Dakwah dan Ilmu Komunikasi UIN Sunan Gunung Djati Bandung")

@section('card-title', "Permohonan Surat Kemahasiswaan Fakultas Dakwah dan Ilmu Komunikasi UIN Sunan Gunung Djati Bandung")

@section('card-body')
    @foreach($tipe_surat as $surat)
        <a href="{{ route('pengajuan.form_surat', ['kode_surat' => $surat->kode_surat]) }}" class="btn btn-primary btn-block my-2">{{ $surat->jenis_surat }}</a>
    @endforeach
@endsection
