@extends("admin.base")

@section('title')
    Sunting Pengajuan Surat @yield('form-name')
@endsection

@section('additional-css')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/css/tempusdominus-bootstrap-4.min.css">
    @yield('css')
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('surat.edit', ['id' => $surat->id])}}" method="post" id="pengajuan-surat" class="form-horizontal">
                        <fieldset>
                            @csrf
                            @method('PUT')
                
                            <div class="form-group">
                                <label class="col-md-6" for="nomor_surat">Nomor Surat</label>
                                <div class="col-auto">
                                    <input required id="nomor_surat" name="nomor_surat" type="text" class="form-control" value="{{ $surat->nomor_surat }}">
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label class="col-md-6" for="tanggal_terbit">Tanggal Terbit</label>
                                <div class="col-auto">
                                    <input required id="tanggal_terbit" type="text" class="form-control datetimepicker-input" name="tanggal_terbit" data-toggle="datetimepicker" data-target="#tanggal_terbit">
                                </div>
                            </div>
                            @yield('form')
                
                            <div class="form-group d-flex justify-space-around">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                <div class="flex-fill"></div>
                                <div class="col-md-5 align-items-end">
                                    <button type="reset" class="btn btn-outline-secondary btn-md">Kosongkan</button>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#tanggal_terbit').datetimepicker({
                defaultDate: "{{ $surat->tanggal_terbit }}",
                locale: "id-ID",
                format: "dddd, DD MMMM YYYY"
            });
        });
    </script>
	@yield('additional-scripts-2')
@endsection
