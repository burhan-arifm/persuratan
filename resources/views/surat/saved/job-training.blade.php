@extends('surat.saved.identitas')

@section('form-name', 'Izin Job Training')

@section('detail-form')
	<div class="row">
		<div class="col-md-4"><strong>Nama Instansi/Lembaga</strong></div>
		<div class="col-auto">
			{{ $surat->job_training->instansi_penerima }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-4"><strong>Alamat Observasi</strong></div>
		<div class="col-auto">
			{{ $surat->job_training->alamat_instansi }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-4"><strong>Kota/Kabupaten</strong></div>
		<div class="col-auto">
			{{ $surat->job_training->kota_lokasi }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-4"><strong>Dosen Pembimbing</strong></div>
		<div class="col-auto">
			{{ $surat->job_training->dosen_pembimbing }}
		</div>
	</div>
@endsection
