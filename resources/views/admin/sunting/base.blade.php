@extends('admin.base')

@section('page-title', "Sunting Surat")

@section('main')
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="#"><em class="fa fa-home"></em></a>
			</li>
			<li class="active">Sunting Surat</li>
			<li class="active">@yield('page-name')</li>
		</ol>
	</div><!--sitemap-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Sunting Surat @yield('page-name')</h1>
		</div>
	</div><!--header-->
	
	<div class="panel panel-container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="alert bg-danger" role="alert"><em class="fas fa-exclamation-triangle">&nbsp;</em> Perhatian! Penulisan Instansi tujuan harus jelas. </em></div>
						<div>Isi form dibawah ini secara lengkap.</div>
						<div>
							<div class="panel-body">
								<form id="pengajuan-surat" class="form-horizontal" action="{{ route('surat.edit', ['id' => $surat->id ]) }}" method="post">
									<fieldset>
										@method('PUT')
										@csrf
										<div class="form-group">
											<label class="col-md-3 control-label" for="nomor_surat">Nomor Surat</label>
											<div class="col-md-6">
												<input id="nomor_surat" name="nomor_surat" type="text" placeholder="Nomor Surat" value="{{ $surat->nomor_surat }}" class="form-control">
											</div>
										</div><!--nomor surat-->

										<div class="form-group">
											<label class="col-md-3 control-label" for="tanggal_terbit">Tanggal Terbit Surat</label>
											<div class="col-md-6">
												<div class="input-group date">
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-th"></span>
													</div>
													<input type="text" class="form-control datepicker" name="tanggal_terbit"value="{{ $surat->tanggal_terbit }}">
												</div>
											</div>
										</div>

										@yield('components')
										<!-- Form actions -->
										<div class="form-group">
											<div class="col-md-6 widget-right">
												<button type="submit" class="btn btn-primary btn-md pull-right">Simpan</button>
											</div>
											<div class="col-md-6 widget-right">
												<button type="reset" class="btn btn-danger btn-md pull-left">Reset</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--body content-->
@endsection