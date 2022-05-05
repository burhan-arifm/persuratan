<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter as Format;
use App\JenisSurat;
use App\Mahasiswa;
use App\ProgramStudi;
use App\Surat;
use Carbon\Carbon;
use HnhDigital\LaravelNumberConverter\Facade as NumConvert;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function daftarFormPengajuan()
    {
        return view("surat.form.index", ['tipe_surat' => JenisSurat::all()]);
    }

    public function formPengajuan($kode_surat)
    {
        try {
            return view("surat.form.$kode_surat", ['program_studi' => \App\ProgramStudi::all(), 'kode_surat' => $kode_surat]);
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function ajukan($kode_surat, Request $request)
    {
        if ($kode_surat == "izin-kunjungan") {
            $program_studi = \App\ProgramStudi::where("kode_program_studi", $request->program_studi)->first();
            $detail = \App\IzinKunjungan::create([
                'instansi_penerima' => $request->instansi_penerima,
                'alamat_instansi'   => $request->alamat_instansi,
                'kota_instansi'     => $request->kota_instansi,
                'mata_kuliah'       => $request->mata_kuliah,
                'program_studi'     => $program_studi->id,
                'semester'          => $request->semester,
                'kelas'             => $request->kelas,
                'dosen_pengampu'    => $request->dosen_pengampu,
                'tanggal_kunjungan' => Carbon::parseFromLocale($request->tanggal_kunjungan, config('app.locale'))->format("Y-m-d"),
                'waktu_kunjungan'   => $request->waktu_kunjungan
            ]);
            $pemohon = "$program_studi->singkatan_program_studi $request->semester-$request->kelas";
        } else {
            $mahasiswa = Mahasiswa::updateOrCreate(
                ['nim' => $request->nim],
                [
                    'nama' => $request->nama,
                    'program_studi' => \App\ProgramStudi::where("kode_program_studi", $request->program_studi)->first()->id,
                    'alamat' => $request->alamat,
                ]
            );
            $pemohon = $mahasiswa->nim;

            switch ($kode_surat) {
                case 'izin-observasi':
                    $mahasiswa->pembimbing_studi = $request->pembimbing_studi;
                    $mahasiswa->save();
                    $detail = \App\IzinObservasi::create([
                        'lokasi_observasi'  => $request->lokasi_observasi,
                        'alamat_lokasi'     => $request->alamat_lokasi,
                        'kota_lokasi'       => $request->kota_lokasi,
                        'topik_skripsi'     => $request->topik_skripsi
                    ]);
                    break;
                case 'izin-praktik':
                    $detail = \App\IzinPraktik::create([
                        'instansi_penerima' => $request->instansi_penerima,
                        'alamat_instansi'   => $request->alamat_instansi,
                        'kota_lokasi'       => $request->kota_lokasi,
                        'mata_kuliah'       => $request->mata_kuliah,
                        'dosen_pengampu'    => $request->dosen_pengampu
                    ]);
                    break;
                case 'izin-riset':
                    $detail = \App\IzinRiset::create([
                        'lokasi_riset'  => $request->lokasi_riset,
                        'alamat_lokasi' => $request->alamat_lokasi,
                        'kota_lokasi'   => $request->kota_lokasi,
                        'judul_skripsi' => $request->judul_skripsi,
                        'pembimbing_1'  => $request->pembimbing_1,
                        'pembimbing_2'  => $request->pembimbing_2
                    ]);
                    break;
                case 'job-training':
                    $detail = \App\JobTraining::create([
                        'instansi_penerima' => $request->instansi_penerima,
                        'alamat_instansi'   => $request->alamat_instansi,
                        'kota_lokasi'       => $request->kota_lokasi,
                        'dosen_pembimbing'  => $request->dosen_pembimbing
                    ]);
                    break;
                case 'ppm':
                    $detail = \App\PPM::create([
                        'instansi_penerima' => $request->instansi_penerima,
                        'alamat_instansi'   => $request->alamat_instansi,
                        'kota_lokasi'       => $request->kota_lokasi,
                        'dosen_pembimbing'  => $request->dosen_pembimbing
                    ]);
                    break;
                    // case 'permohonan-munaqasah':
                    //     $detail = \App\PermohonanMunaqasah::create([
                    //         'judul_skripsi' => $request->judul_skripsi,
                    //         'pembimbing_1' => $request->pembimbing_1,
                    //         'pembimbing_2' => $request->pembimbing_2
                    //     ]);
                    //     break;
                    // case 'pernyataan-masih-kuliah':
                    //     $pangkat_golongan = explode(" - ", $request->pangkat_golongan);
                    //     $detail = \App\MasihKuliah::create([
                    //         'nama_orang_tua' => $request->nama_orang_tua,
                    //         'nip_orang_tua' => $request->nip_orang_tua,
                    //         'pangkat' => $pangkat_golongan[0],
                    //         'golongan' => $pangkat_golongan[1],
                    //         'instansi' => $request->instansi
                    //     ]);
                    //     break;
                    // case 'surat-keterangan':
                    //     $detail = \App\Keterangan::create([
                    //         'keperluan' => $request->keperluan
                    //     ]);
                    //     break;
                    // case 'permohonan-komprehensif':

                default:
                    break;
            }
        }


        $surat_terakhir = (Surat::whereYear('created_at', Carbon::now()->year)->count() != 0)
            ? Surat::whereYear('created_at', Carbon::now()->year)->latest()->first()->nomor_surat
            : 0;
        $surat = Surat::create([
            'nomor_surat' => $surat_terakhir + 1,
            'jenis_surat' => \App\JenisSurat::where('kode_surat', $kode_surat)->first()->id,
            'pemohon' => $pemohon,
            'surat' => $detail->id,
            'status_surat' => "Belum Diproses",
            'tanggal_terbit' => Carbon::now()->toDateString()
        ]);
        event(new \App\Events\SuratDiajukan($surat));

        return view("surat.saved.$kode_surat", ['surat' => $surat]);
    }

    public function semua()
    {
        $persuratan = Surat::all();
        $letters = [];

        foreach ($persuratan as $surat) {
            $formatted = Format::surat_table($surat);
            $surat->nomor_surat = $formatted['nomor_surat'];
            $surat->jenis_surat = $formatted['jenis_surat'];
            $surat->pemohon = "{$formatted['identitas']} - {$formatted['pemohon']}";

            // eager loading
            if ($surat->jenis_surat != "Izin Kunjungan") $surat->mahasiswa->jurusan;
            // dynamic eager loading, because orm relation name between surat and tipe surat and 'kode surat' are similar
            $surat[\str_replace("-", "_", $surat->jenis->kode_surat)];

            $letters[] = $surat;
        }

        return view('admin.riwayat', ['tipe_surat' => JenisSurat::all(), 'letters' => $letters]);
    }

    public function detail($id)
    {
        try {
            $surat = Surat::find($id);
            if ($surat) {
                $surat = $this->setSurat($surat);

                return view("admin.detail.{$surat->jenis->kode_surat}", ['surat' => $surat]);
            }

            return response('Surat tidak ditemukan.', 404);
        } catch (\Throwable $th) {
            return response('Internal Server Error', 500);
        }
    }

    public function cetak($id)
    {
        $surat = Surat::find($id);
        $surat->status_surat = "Telah Diproses";
        $surat->save();
        $surat = $this->setSurat($surat);

        event(new \App\Events\SuratDiproses($surat));

        return view("surat.cetak.{$surat->jenis->kode_surat}", ['surat' => $surat]);
    }

    public function formSunting($id)
    {
        $surat = Surat::find($id);

        if ($surat) {
            $time = Carbon::createFromFormat('Y-m-d', $surat->tanggal_terbit);
            $nomor_surat = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $surat->nomor_surat, $time->month, $time->year);
            $surat->nomor_surat = $nomor_surat;
            $surat->tanggal_terbit = $time;

            return view(
                "admin.sunting.{$surat->jenis->kode_surat}",
                [
                    'surat' => $surat,
                    'program_studi' => ProgramStudi::all(),
                    'tipe_surat' => JenisSurat::all()
                ]
            );
        }

        abort(404);
    }

    public function sunting($id, Request $request)
    {
        $surat = Surat::find($id);

        if ($surat) {
            if ($surat->jenis->kode_surat == "izin-kunjungan") {
                $program_studi = \App\ProgramStudi::where("kode_program_studi", $request->program_studi)->first();
                \App\IzinKunjungan::find($surat->surat)->update([
                    'instansi_penerima' => $request->instansi_penerima,
                    'alamat_instansi'   => $request->alamat_instansi,
                    'kota_instansi'     => $request->kota_instansi,
                    'mata_kuliah'       => $request->mata_kuliah,
                    'program_studi'     => $program_studi->id,
                    'semester'          => $request->semester,
                    'kelas'             => $request->kelas,
                    'dosen_pengampu'    => $request->dosen_pengampu,
                    'tanggal_kunjungan' => Carbon::parseFromLocale($request->tanggal_kunjungan, config('app.locale'))->format("Y-m-d"),
                    'waktu_kunjungan'   => $request->waktu_kunjungan
                ]);
                $pemohon = "$program_studi->singkatan_program_studi $request->semester-$request->kelas";
            } else {
                $mahasiswa = Mahasiswa::updateOrCreate(
                    ['nim' => $request->nim],
                    [
                        'nama' => $request->nama,
                        'program_studi' => \App\ProgramStudi::where("kode_program_studi", $request->program_studi)->first()->id,
                        'alamat' => $request->alamat,
                    ]
                );
                $pemohon = $mahasiswa->nim;

                switch ($surat->jenis->kode_surat) {
                    case 'izin-observasi':
                        $mahasiswa->pembimbing_studi = $request->pembimbing_studi;
                        $mahasiswa->save();
                        \App\IzinObservasi::find($surat->surat)->update([
                            'lokasi_observasi'  => $request->lokasi_observasi,
                            'alamat_lokasi'     => $request->alamat_lokasi,
                            'kota_lokasi'       => $request->kota_lokasi,
                            'topik_skripsi'     => $request->topik_skripsi
                        ]);
                        break;
                    case 'izin-praktik':
                        \App\IzinPraktik::find($surat->surat)->update([
                            'instansi_penerima' => $request->instansi_penerima,
                            'alamat_instansi' => $request->alamat_instansi,
                            'kota_lokasi'       => $request->kota_lokasi,
                            'mata_kuliah' => $request->mata_kuliah,
                            'dosen_pengampu' => $request->dosen_pengampu
                        ]);
                        break;
                    case 'izin-riset':
                        \App\IzinRiset::find($surat->surat)->update([
                            'lokasi_riset'  => $request->lokasi_riset,
                            'alamat_lokasi' => $request->alamat_lokasi,
                            'kota_lokasi'   => $request->kota_lokasi,
                            'judul_skripsi' => $request->judul_skripsi,
                            'pembimbing_1'  => $request->pembimbing_1,
                            'pembimbing_2'  => $request->pembimbing_2
                        ]);
                        break;
                    case 'job-training':
                        \App\JobTraining::find($surat->surat)->update([
                            'instansi_penerima' => $request->instansi_penerima,
                            'alamat_instansi' => $request->alamat_instansi,
                            'kota_lokasi'       => $request->kota_lokasi,
                            'dosen_pembimbing' => $request->dosen_pembimbing
                        ]);
                        break;
                    case 'ppm':
                        \App\PPM::find($surat->surat)->update([
                            'instansi_penerima' => $request->instansi_penerima,
                            'alamat_instansi' => $request->alamat_instansi,
                            'kota_lokasi'       => $request->kota_lokasi,
                            'dosen_pembimbing' => $request->dosen_pembimbing
                        ]);
                        break;
                        // case 'permohonan-munaqasah':
                        //     \App\PermohonanMunaqasah::find($surat->surat)->update([
                        //         'judul_skripsi' => $request->judul_skripsi,
                        //         'pembimbing_1' => $request->pembimbing_1,
                        //         'pembimbing_2' => $request->pembimbing_2
                        //     ]);
                        //     break;
                        // case 'pernyataan-masih-kuliah':
                        //     $pangol = explode(" - ", $request->pangkat_golongan);
                        //     \App\MasihKuliah::find($surat->surat)->update([
                        //         'nama_orang_tua' => $request->nama_orang_tua,
                        //         'nip_orang_tua' => $request->nip_orang_tua,
                        //         'pangkat' => $pangol[0],
                        //         'golongan' => $pangol[1],
                        //         'instansi' => $request->instansi
                        //     ]);
                        //     break;
                        // case 'surat-keterangan':
                        //     \App\Keterangan::find($surat->surat)->update([
                        //         'keperluan' => $request->keperluan
                        //     ]);
                        //     break;
                        // case 'permohonan-komprehensif':

                    default:
                        break;
                }
            }

            $nomor = explode("/", $request->nomor_surat);
            $nomor_surat = explode("-", $nomor[0]);
            $surat->find($id)->update([
                'nomor_surat'    => intval($nomor_surat[1]),
                'pemohon'        => $pemohon,
                'status_surat'   => "Belum Diproses",
                'tanggal_terbit' => Carbon::parseFromLocale($request->tanggal_terbit, config('app.locale'))->format("Y-m-d"),
            ]);
            event(new \App\Events\SuratDisunting($surat));

            return redirect()->route('surat.riwayat')->with('message', ['title' => 'Surat berhasil diperbaharui.', 'icon' => 'success']);
        }

        abort(404);
    }

    public function hapus($id)
    {
        try {
            $surat = Surat::find($id);

            if ($surat) {
                switch ($surat->jenis->kode_surat) {
                    case 'izin-kunjungan':
                        \App\IzinKunjungan::destroy($surat->surat);
                        break;
                    case 'izin-observasi':
                        \App\IzinObservasi::destroy($surat->surat);
                        break;
                    case 'izin-praktik':
                        \App\IzinPraktik::destroy($surat->surat);
                        break;
                    case 'izin-riset':
                        \App\IzinRiset::destroy($surat->surat);
                        break;
                    case 'job-training':
                        \App\JobTraining::destroy($surat->surat);
                        break;
                    case 'ppm':
                        \App\PPM::destroy($surat->surat);
                        break;
                        // case 'permohonan-komprehensif':
                        //     \App\Komprehensif::destroy($surat->surat);
                        //     break;
                        // case 'permohonan-munaqasah':
                        //     \App\Munaqasah::destroy($surat->surat);
                        //     break;
                        // case 'pernyataan-masih-kuliah':
                        //     \App\MasihKuliah::destroy($surat->surat);
                        //     break;
                        // case 'surat-keterangan':
                        //     \App\Keterangan::destroy($surat->surat);
                        //     break;

                    default:
                        break;
                }

                Surat::destroy($id);

                event(new \App\Events\SuratDihapus($id));

                return response()->noContent();
            }

            return response('Surat tidak ditemukan.', 404);
        } catch (\Throwable $th) {
            return response('Internal Server Error', 500);
        }
    }

    public function pengaturanSurat($kode_surat)
    {
        $jenis_surat = JenisSurat::where('kode_surat', $kode_surat)->first();

        return view("admin.pengaturan.surat", ['surat' => $jenis_surat, 'tipe_surat' => JenisSurat::all()]);
    }

    public function simpanPengaturan(Request $request)
    {
        \App\JenisSurat::find($request->id)->update([
            'jenis_surat' => $request->jenis_surat,
            'perihal' => $request->perihal,
            'atas_nama' => $request->atas_nama,
            'penanda_tangan' => $request->penanda_tangan,
            'nip_penanda_tangan' => $request->nip_penanda_tangan,
            'jabatan_penanda_tangan' => $request->jabatan_penanda_tangan
        ]);

        return redirect()->route('beranda')->with('message', ['title' => 'Perubahan berhasil disimpan', 'icon' => 'success']);
    }

    private function setSurat($surat)
    {
        $surat->perihal = html_entity_decode($surat->jenis->perihal);
        $tanggal_terbit = Carbon::createFromFormat('Y-m-d', $surat->tanggal_terbit);
        $surat->nomor_surat = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $surat->nomor_surat, $tanggal_terbit->month, $tanggal_terbit->year);
        $surat->tanggal_terbit = $tanggal_terbit->isoFormat('DD MMMM Y');

        if ($surat->jenis->kode_surat == 'izin-kunjungan') {
            $waktu_kunjungan = new Carbon("{$surat->izin_kunjungan->tanggal_kunjungan} {$surat->izin_kunjungan->waktu_kunjungan}", config('app.timezone'));
            $surat->tanggal_kunjungan = $waktu_kunjungan->isoFormat('dddd, DD MMMM YYYY');
            $surat->waktu_kunjungan = $waktu_kunjungan->isoFormat('HH:mm \\WIB');
        } else {
            $batch = substr($surat->mahasiswa->nim, 1, 2);
            $enroll = Carbon::createFromFormat('j n y', "1 7 $batch", config('app.timezone'));
            $roman_semester = NumConvert::roman(intval(ceil($enroll->diffInMonths($tanggal_terbit) / 6)));
            $formatter = new \NumberFormatter(config('app.locale'), \NumberFormatter::SPELLOUT);
            $word_semester = ucfirst($formatter->format(ceil($enroll->diffInMonths($tanggal_terbit) / 6)));
            $semester = "$roman_semester ($word_semester)";
            $surat->mahasiswa->semester = $semester;
        }

        return $surat;
    }
}
