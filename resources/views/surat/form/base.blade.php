@extends('layouts.app')

@section('page-title')
	@yield('page-title')
@endsection

@section('additional-css')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.47/build/css/bootstrap-datetimepicker.min.css">
@endsection

@section('body')
	<div class="container-fluid">		
		<div class="card mt-3">
			<div class="card-body">
				<form id="pengajuan-surat" class="form-horizontal" action="{{ route('ajukan_surat') }}" method="post">
					<fieldset>
						@csrf
						@yield('main')
						<!-- Form actions -->
						<div class="form-group">
							<div class="col-md-6 widget-right">
								<button type="submit" class="btn btn-primary btn-md pull-right">Ajukan</button>
							</div>
							<div class="col-md-6 widget-right">
								<button type="reset" class="btn btn-danger btn-md pull-left">Kosongkan</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div><!--body content-->
	</div>
	<!--content-->
@endsection

@section('additional-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.8/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.47/build/js/bootstrap-datetimepicker.min.js"></script>
	@yield('additional-scripts')
@endsection