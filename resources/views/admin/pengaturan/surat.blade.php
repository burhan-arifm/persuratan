@extends("admin.base")

@section('title')
    Sunting Surat {{ $surat->jenis_surat }}
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('pengaturan.surat.simpan', ['kode_surat' => $surat->kode_surat])}}" method="post" id="sunting-surat" class="form-horizontal">
                        <fieldset>
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $surat->id }}">
                            <div class="form-group">
                                <label for="kode_surat">Kode Surat</label>
                                <input disabled id="kode_surat" name="kode_surat" type="text" class="form-control" value="{{ $surat->kode_surat }}">
                            </div>
                            <div class="form-group">
                                <label for="jenis_surat">Jenis Surat</label>
                                <input required id="jenis_surat" name="jenis_surat" type="text" class="form-control" value="{{ $surat->jenis_surat }}">
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea required class="form-control" id="perihal" name="perihal" rows="3" data-toggle="tooltip">{{ $surat->perihal }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="penanda_tangan">Penanda Tangan</label>
                                <input required id="penanda_tangan" name="penanda_tangan" type="text" class="form-control" value="{{ $surat->penanda_tangan }}">
                            </div>
                            <div class="form-group">
                                <label for="nip_penanda_tangan">NIP Penanda Tangan</label>
                                <input required id="nip" name="nip_penanda_tangan" type="text" class="form-control" value="{{ $surat->nip_penanda_tangan }}">
                            </div>
                            <div class="form-group">
                                <label for="jabatan_penanda_tangan">Jabatan Penanda Tangan</label>
                                <input required id="jabatan_penanda_tangan" name="jabatan_penanda_tangan" type="text" class="form-control" value="{{ $surat->jabatan_penanda_tangan }}">
                            </div>
                            <div class="form-group">
                                <label for="atas_nama">Menandatangani Atas Nama</label>
                                <input required id="atas_nama" name="atas_nama" type="text" class="form-control" value="{{ $surat->atas_nama }}">
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
@endsection
