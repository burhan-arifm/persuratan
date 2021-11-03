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
                    <b>{{ $surat->izin_kunjungan->instansi_penerima }}</b><br>
                    {{ $surat->izin_kunjungan->alamat_instansi }}<br>
                    {{ $surat->izin_kunjungan->kota_instansi }}
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
                    Dekan Fakultas Dakwah dan Komunikasi Universitas Islam Negeri (UIN) Sunan Gunung Djati Bandung, dengan ini memohon kesediaan Bapak/ Ibu/ Saudara untuk memberikan izin kepada mahasiswa kami dalam rangka kunjungan:
                </p>
                <!-- end of Pembuka Surat -->

                <!-- Isi Surat -->
                <table class="table table-sm table-borderless" style="margin-left: 2.2em;">
                    <tbody>
                        <tr>
                            <td>Mata Kuliah</td>
                            <td>:</td>
                            <td>{{ $surat->izin_kunjungan->mata_kuliah }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td>{{ $surat->program_studi }}</td>
                        </tr>
                        <tr>
                            <td>Semester/Kelas</td>
                            <td>:</td>
                            <td>{{ $surat->izin_kunjungan->semester }}/{{ $surat->izin_kunjungan->kelas }}</td>
                        </tr>
                        <tr>
                            <td>Dosen Pengampu</td>
                            <td>:</td>
                            <td>{{ $surat->izin_kunjungan->dosen_pengampu }}</td>
                        </tr>
                        <tr>
                            <td>Hari / Tanggal</td>
                            <td>:</td>
                            <td>{{ $surat->tanggal_kunjungan }}</td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td>{{ $surat->waktu_kunjungan }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- end of Isi Surat -->

                <!-- Penutup Surat -->
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