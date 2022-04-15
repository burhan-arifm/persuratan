@extends("admin.base")

@section('title')
Pengaturan Akun
@endsection

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="identity-tab" data-toggle="tab" href="#identity" role="tab"
                            aria-controls="identity" aria-selected="true">Informasi Akun</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password"
                            role="tab" aria-controls="change-password" aria-selected="false">Ganti Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active py-3" id="identity" role="tabpanel"
                        aria-labelledby="identity-tab">
                        <form action="{{ route('pengaturan.akun.simpan-akun') }}" method="post" class="form-horizontal">
                            <fieldset>
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label `for="name">Nama</label>
                                    <input required id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" data-toggle="tooltip"
                                        title="Masukkan nama Anda" data-placement="top"
                                        value="{{ Auth::user()->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input required id="username" name="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror"
                                        data-toggle="tooltip" title="Masukkan username Anda" data-placement="top"
                                        value="{{ Auth::user()->username }}">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input id="nip" name="nip" type="text"
                                        class="form-control @error('nip') is-invalid @enderror" data-toggle="tooltip"
                                        title="Masukkan NIP Anda" data-placement="top" value="{{ Auth::user()->nip }}">
                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" data-toggle="tooltip"
                                        title="Masukkan e-mail Anda" data-placement="top"
                                        value="{{ Auth::user()->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>`
                                <div class="form-group d-flex justify-space-around">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="tab-pane fade py-3" id="change-password" role="tabpanel"
                        aria-labelledby="change-password-tab">
                        <form action="{{ route('pengaturan.akun.ganti-sandi') }}" method="post" class="form-horizontal">
                            <fieldset>
                                @csrf
                                @method('PUT')
                                <input hidden type="text" name="username" value="{{ Auth::user()->username }}">
                                <div class="form-group">
                                    <label for="current_password">Password Lama</label>
                                    <input id="current_password" name="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        data-toggle="tooltip" title="Masukkan password lama Anda" data-placement="top"
                                        autocomplete="current-password">
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <input id="new_password" name="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        data-toggle="tooltip" title="Masukkan password baru Anda" data-placement="top"
                                        autocomplete="new-password">
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                    <input id="new_password_confirmation" name="new_password_confirmation"
                                        type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        data-toggle="tooltip" title="Masukkan kembali password baru Anda"
                                        data-placement="top" autocomplete="new-password">
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group d-flex justify-space-around">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js">
</script>
<script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
@endsection