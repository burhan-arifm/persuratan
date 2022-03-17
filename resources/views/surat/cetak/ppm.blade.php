@extends('surat.cetak.permohonan-izin')

@section('isi-surat')
<!-- Isi Surat -->
<div class="row my-3">
    <div class="col-2"></div>
    <div class="col-10">
        <!-- Penerima Surat -->
        <div class="row">
            <p>
                Kepada Yth.<br>
                <b>{{ $surat->ppm->instansi_penerima }}</b><br>
                {{ $surat->ppm->alamat_instansi }}<br>
                {{ $surat->ppm->kota_lokasi }}
            </p>
        </div>
        <!-- end of Penerima Surat -->

        <!-- Konten Surat -->
        <div class="row mt-1">
            <!-- Pembuka Surat -->
            <p class="first-line-indent mini-margin">
                <b><em>Assalamu'alaikum Wr. Wb.</em></b>
            </p>
            <p class="text-justify first-line-indent">
                Dekan Fakultas Dakwah dan Komunikasi Universitas Islam Negeri (UIN) Sunan Gunung Djati Bandung, dengan
                ini mohon kesediaan Bapak/ Ibu/ Saudara untuk memberikan izin kepada mahasiswa kami sebagai berikut:
            </p>
            <!-- end of Pembuka Surat -->

            <!-- Isi Surat -->
            <table class="table table-sm table-borderless" style="margin-left: 2.2em;">
                <tbody>
                    <tr>
                        <td>N a m a</td>
                        <td>:</td>
                        <td>{{ $surat->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Pokok</td>
                        <td>:</td>
                        <td>{{ $surat->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{ $surat->mahasiswa->jurusan->nama_program_studi }}</td>
                    </tr>
                    <tr>
                        <td>Program/Semester</td>
                        <td>:</td>
                        <td>S1/{{ $surat->mahasiswa->semester }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $surat->mahasiswa->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Pembimbing Studi</td>
                        <td>:</td>
                        <td>{{ $surat->ppm->dosen_pembimbing }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- end of Isi Surat -->

            <!-- Penutup Surat -->
            <p class="text-justify mini-margin">
                untuk melaksanakan <b><em>Persiapan Praktik Profesi Mahasiswa (PPM)</em></b> di Lembaga yang Bapak/ Ibu/
                Saudara pimpin.
            </p>
            <p class="first-line-indent mini-margin">Atas bantuan Bapak/ Ibu/ Saudara, kami ucapkan terima kasih.</p>
            <p class="first-line-indent mini-margin">
                <b><em>Wassalamu'alaikum Wr. Wb.</em></b>
            </p>
            <!-- end of Penutup Surat -->
        </div>
        <!-- end of Konten Surat -->
    </div>
</div>
<!-- end of Isi Surat -->
@endsection
