<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function semua()
    {
        return view('admin.riwayat');
    }

    public function sunting($id)
    {
        $surat = \App\Surat::find($id);

        $time = \Carbon\Carbon::createFromFormat('Y-m-d', $surat->tanggal_terbit);
        $nomor_surat = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $surat->nomor_surat, $time->month, $time->year);
        $surat->nomor_surat = $nomor_surat;
        $surat->tanggal_terbit = $time;

        return view("admin.sunting.$surat->jenis_surat", [
            'surat' => $surat,
            'program_studi' => \App\ProgramStudi::all(),
            ]);
    }

    public function pengaturanUmum()
    {
        return view('admin.pengaturan');
    }

    public function simpanPengaturan(Request $request)
    {
        
    }

    public function laporan()
    {
        # code...
    }
}
