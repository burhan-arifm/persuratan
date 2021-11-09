@extends('layouts.app')

@section('additional-css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    @yield('css')
@endsection

@section('body')
    <div class="container-md d-flex justify-content-center">
        <div class="col-md-10 align-items-center">
            <div class="card mt-5 border-top-primary border-bottom-primary">
                <div class="card-body">
                    <h3 class="card-title mb-3">@yield('card-title')</h3>
                    @yield('card-body')
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

@section('additional-scripts')
    @yield('scripts')
@endsection