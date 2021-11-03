@extends('surat.cetak.base')

@section('badan-surat')
    <!-- Atribut Surat -->
    <div class="row">
        <table class="table table-sm table-borderless">
            <tbody>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td style="text-align: right;">Bandung, {{ $surat->tanggal_terbit }}</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td><div><b><em>
                        {!! $surat->perihal !!}
                    </em></b></div></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- end of Atribut Surat -->

    @yield('isi-surat')

    <!-- Penanda Tangan Surat -->
    <div class="row">
        <div class="col"></div>
        <div class="col text-right">
            a.n.
        </div>
        <div class="col">
            <div class="row">{{ $surat->jenis->atas_nama }}</div>
            <div class="row">{{ $surat->jenis->jabatan_penanda_tangan }},</div>
            <div class="row"><br></div>
            <div class="row"><br></div>
            <div class="row"><br></div>
            <div class="row"><b>{{ $surat->jenis->penanda_tangan }}</b></div>
            <div class="row">NIP.{{ $surat->jenis->nip_penanda_tangan }}</div>
        </div>
    </div>
    <!-- end of Penanda Tangan Surat -->

    <!-- Keterangan Surat -->
    <div class="row mt-5">
        <p>
            Tembusan:<br>
            Yth. Dekan Fakultas Dakwah dan Komunikasi Universitas Islam Negeri Sunan Gunung Djati Bandung (sebagai laporan)
        </p>
    </div>
    <!-- end of Keterangan Surat -->
@endsection