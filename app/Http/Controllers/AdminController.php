<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home', ['tipe_surat' => \App\JenisSurat::all()]);
    }

    public function semua()
    {
        return view('admin.riwayat', ['tipe_surat' => \App\JenisSurat::all()]);
    }

    public function sunting($id)
    {
        $surat = \App\Surat::find($id);

        $time = \Carbon\Carbon::createFromFormat('Y-m-d', $surat->tanggal_terbit);
        $nomor_surat = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $surat->nomor_surat, $time->month, $time->year);
        $surat->nomor_surat = $nomor_surat;
        $surat->tanggal_terbit = $time;

        return view("admin.sunting.{$surat->jenis->kode_surat}", [
            'surat' => $surat,
            'program_studi' => \App\ProgramStudi::all(),
            ]);
    }

    public function pengaturanSurat($kode_surat)
    {
        $jenis_surat = \App\JenisSurat::where('kode_surat', $kode_surat)->first();

        return view("admin.pengaturan.surat", ['surat' => $jenis_surat, 'tipe_surat' => \App\JenisSurat::all()]);
    }

    public function simpanPengaturan(Request $request)
    {
        //TODO: validasi input pengaturan
        //TODO: simpan pengaturan akun
    }

    public function laporan()
    {
        //TODO: generate laporan ke dalam bentuk csv, xls, pdf, atau doc
    }
}
