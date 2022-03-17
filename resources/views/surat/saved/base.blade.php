@extends('layouts.app')

@section('page-title')
Pengajuan Surat @yield('form-name')
@endsection

@section('additional-css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@yield('css')
@endsection

@section('body')
<div class="container-md d-flex justify-content-center">
    <div class="col-md-10 align-items-center">
        <div class="card mt-5 border-top-primary border-bottom-primary">
            <div class="card-body">
                <h3 class="card-title mb-3">Formulir Pengajuan Surat @yield('form-name')</h3>
                <p class="card-text">
                    Pengajuan Anda telah tersimpan. Berikut adalah data yang Anda masukkan. Anda dapat mengambil surat
                    tersebut di Tata Usaha Fakultas Dakwah dan Komunikasi Universitas Islam Negeri Sunan Gunung Djati
                    Bandung. Apabila terdapat kesalahan data, mohon untuk segera menghubungi Tata Usaha Fakultas Dakwah
                    dan Komunikasi Universitas Islam Negeri Sunan Gunung Djati Bandung
                </p>
                @yield('card-body')
            </div>
            <div class="card-footer">
                <a href="{{ route('pengajuan.index') }}" class="font-weight-bold">Buat pengajuan surat yang lain</a>
            </div>
        </div>
    </div>
</div>
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto font-weight-bold text-dark">
            <span>Copyright &copy; SIMDAK-FIDKOM {{ now()->year }}</span>
        </div>
    </div>
</footer>
@endsection
