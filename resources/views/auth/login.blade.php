@extends('layouts.app')

@section('page-title', 'Masuk | SIMDAK-FIDKOM UIN Sunan Gunung Djati Bandung')

@section('additional-css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('body')
    <main class="h-100">
        <div class="container d-flex flex-column justify-content-center h-100">
            <div class="row mb-3">
                <div class="col align-items-center">
                    <h4 class="text-center font-weight-bold">SISTEM INFORMASI MANAJEMEN DATA AKADEMIK</h4>
                    <h4 class="text-center font-weight-bold">FAKULTAS ILMU DAKWAH DAN ILMU KOMUNIKASI</h4>
                    <h4 class="text-center font-weight-bold">UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI BANDUNG</h4>
                </div>
            </div>
            <div id="loginwrapper" class="row justify-content-center align-items-center">
                <div class="col-md-2 mb-2 mr-4 align-items-center">
                    <div class="row align-items-center">
                        <picture class="mx-auto my-auto">
                            <source media="(max-width: 768px)" srcset="{{ asset('storage/uinsgd-logo.png') }}" style="height: auto; max-width: 10%;" >
                            <img src="{{ asset('storage/uin-bandung-logo.png') }}" alt="Logo UIN Sunan Gunung Djati Bandung" style="height: auto; max-width: 100%;" >
                        </picture>
                    </div>
                </div>
                <div class="vertical-ruler"></div>
                <div class="col-md-4">
                    <div class="card border-0 @if($errors->has('email') || $errors->has('nip')) is-invalid @endif">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <label for="identity">NIP / username / e-mail</label>
                                        <input required id="identity" class="form-control" placeholder="NIP" name="identity" type="text" autofocus required autocomplete>
                                        @if($errors->get('email') || $errors->get('nip')|| $errors->get('username'))
                                            <span class="invalid-feedback" role="alert">
                                            @foreach ($errors->all() as $message)
                                                <strong>{{ $message }}</strong>
                                            @endforeach
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input required class="form-control @error('password') is-invalid @enderror" placeholder="Password" type="password" name="password" required autocomplete>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" value="Remember Me"><span class="mx-2">Ingat Saya</span>
                                        </label>
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="Login">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="sticky-footer w-100 fixed-bottom">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; SIMDAK-FIDKOM {{ now()->year }}</span>
            </div>
        </div>
    </footer>
@endsection
