@extends("surat.form.layout")

@section('page-title')
    Pengajuan Surat @yield('form-name')
@endsection

@section('css')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
    @yield('additional-css-2')
@endsection

@section('card-title') 
    Formulir Pengajuan Surat @yield('form-name')
@endsection

@section('card-body')
    <form action="{{route('ajukan_surat')}}" method="post" id="pengajuan-surat" class="form-horizontal">
        <fieldset>
            @csrf
            @yield('form')

            <div class="form-group d-flex justify-space-around">
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
                <div class="flex-fill"></div>
                <div class="col-md-5 align-items-end">
                    <button type="reset" class="btn btn-outline-secondary btn-md">Kosongkan</button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
	@yield('additional-scripts-2')
@endsection
