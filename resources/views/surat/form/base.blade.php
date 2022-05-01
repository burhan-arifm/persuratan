@extends("surat.form.layout")

@section('page-title')
Pengajuan Surat @yield('form-name')
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/css/select2.min.css">
@yield('additional-css-2')
@endsection

@section('card-title')
Formulir Pengajuan Surat @yield('form-name')
@endsection

@section('card-body')
<form action="{{route('pengajuan.ajukan_surat', ['kode_surat' => $kode_surat])}}" method="post" id="pengajuan-surat"
    class="needs-validation" novalidate>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        const validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
    })();
</script>
@yield('additional-scripts-2')
@endsection
