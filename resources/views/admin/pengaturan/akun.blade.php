@extends("admin.base")

@section('title')
    Sunting Pengajuan Surat @yield('form-name')
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pengaturan.akun.simpan') }}" method="post" class="form-horizontal">
                        <fieldset>
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="identity-tab" data-toggle="tab" href="#identity" role="tab" aria-controls="identity" aria-selected="true">Informasi Akun</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Ganti Password</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active py-3" id="identity" role="tabpanel" aria-labelledby="identity-tab">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input required id="name" name="name" type="text" class="form-control" data-toggle="tooltip" title="Masukkan nama Anda" data-placement="top" value="{{ Auth::user()->name }}">
                                        <div class="invalid-feedback">
                                            Wajib diisi.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input required id="username" name="username" type="text" class="form-control" data-toggle="tooltip" title="Masukkan username Anda" data-placement="top" value="{{ Auth::user()->username }}">
                                        <div class="invalid-feedback">
                                            Wajib diisi.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input id="nip" name="nip" type="text" class="form-control" data-toggle="tooltip" title="Masukkan NIP Anda" data-placement="top" value="{{ Auth::user()->nip }}">
                                        <div class="invalid-feedback">
                                            Wajib diisi.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email" class="form-control" data-toggle="tooltip" title="Masukkan e-mail Anda" data-placement="top" value="{{ Auth::user()->email }}">
                                        <div class="invalid-feedback">
                                            Wajib diisi.
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                    <div class="form-group">
                                        <label for="old_password">Password Lama</label>
                                        <input id="old_password" name="old_password" type="password" class="form-control @error('password') is-invalid @enderror" data-toggle="tooltip" title="Masukkan password lama Anda" data-placement="top">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">Password Baru</label>
                                        <input id="new_password" name="old_password" type="password" class="form-control @error('password') is-invalid @enderror" data-toggle="tooltip" title="Masukkan password baru Anda" data-placement="top" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Konfirmasi Password Baru</label>
                                        <input id="confirm_password" name="old_password" type="password" class="form-control" data-toggle="tooltip" title="Masukkan kembali password baru Anda" data-placement="top" autocomplete="new-password">
                                        <div class="invalid-feedback">
                                            Wajib diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-space-around">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
	@yield('additional-scripts-2')
@endsection
