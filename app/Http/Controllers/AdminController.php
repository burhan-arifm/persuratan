<?php

namespace App\Http\Controllers;

use App\Admin;
use App\JenisSurat;
use App\ProgramStudi;
use App\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $persuratan =  Surat::where('status_surat', "Belum Diproses")->get();
        $letters = [];

        foreach ($persuratan as $surat) {
            $letters[] = \Format::surat_table($surat);
        }

        return view('admin.home', ['tipe_surat' => JenisSurat::all(), 'letters' => $letters]);
    }

    public function semua()
    {
        $persuratan = Surat::all();
        $letters = [];

        foreach ($persuratan as $surat) {
            $formatted = \Format::surat_table($surat);
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

    public function sunting($id)
    {
        $surat = Surat::find($id);

        $time = Carbon::createFromFormat('Y-m-d', $surat->tanggal_terbit);
        $nomor_surat = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $surat->nomor_surat, $time->month, $time->year);
        $surat->nomor_surat = $nomor_surat;
        $surat->tanggal_terbit = $time;

        return view("admin.sunting.{$surat->jenis->kode_surat}", ['surat' => $surat, 'program_studi' => ProgramStudi::all(), 'tipe_surat' => JenisSurat::all()]);
    }

    public function pengaturanSurat($kode_surat)
    {
        $jenis_surat = JenisSurat::where('kode_surat', $kode_surat)->first();

        return view("admin.pengaturan.surat", ['surat' => $jenis_surat, 'tipe_surat' => JenisSurat::all()]);
    }

    public function simpanPengaturan(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:20', Rule::unique('admins')->ignore(auth()->user()->id)],
            'username' => ['required', 'string', 'max:20', Rule::unique('admins')->ignore(auth()->user()->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore(auth()->user()->id)],
        ]);

        Admin::find(auth()->user()->id)->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return back()->with('message', ['title' => 'Perubahan berhasil disimpan.', 'icon' => 'success']);
    }
}
