<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Helpers\Formatter as Format;
use App\JenisSurat;
use App\Providers\RouteServiceProvider;
use App\Rules\MatchOldPassword;
use App\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(['identity'  => 'required|string']);
        $username = function () use ($request) {
            $login = $request->only(['identity']);
            $field = filter_var($login['identity'], FILTER_VALIDATE_EMAIL)
                ? 'email'
                : (filter_var(
                    $login['identity'],
                    FILTER_VALIDATE_REGEXP,
                    array(
                        'options' => array(
                            'regexp' => '/[0-9]{18}|[0-9]{8}.[0-9]{6}.[1|2]{1}.[0-9]{3}|[0-9]{8} [0-9]{6} [1|2]{1} [0-9]{3}|[0-9]{18}/'
                        )
                    )
                )
                    ? 'nip'
                    : 'username'
                );
            if ($field == 'nip') {
                $login = str_replace(array('.', ' '), '', $login['identity']);
                $request->merge([$field => $login]);
            } else {
                $request->merge([$field => $login['identity']]);
            }
            return $field;
        };
        $credentials = $request->only([$username(), 'password']);
        $validator = Validator::make($credentials, [
            $username() => 'required|exists:admins',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withInput($request->only('remember'))
                ->withErrors($validator);
        }
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()->route('login')
            ->withInput($request->only('identity', 'remember'))
            ->withErrors([
                'password' => __('auth.failed'),
            ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function homeDashboard()
    {
        $persuratan =  Surat::where('status_surat', "Belum Diproses")->get();
        $letters = [];

        foreach ($persuratan as $surat) {
            $letters[] = Format::surat_table($surat);
        }

        return view('admin.home', ['tipe_surat' => JenisSurat::all(), 'letters' => $letters]);
    }

    public function pengaturanAkun()
    {
        return view("admin.pengaturan.akun", ['tipe_surat' => JenisSurat::all()]);
    }

    public function pengaturanAdmin()
    {
        $admins = Admin::where('is_admin', false)->get();
        return view("admin.pengaturan.admin.index", ['tipe_surat' => JenisSurat::all(), 'admins' => $admins]);
    }

    public function simpanPengaturan(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'regex:/[0-9]{18}|[0-9]{8}.[0-9]{6}.[1|2]{1}.[0-9]{3}|[0-9]{8} [0-9]{6} [1|2]{1} [0-9]{3}|[0-9]{18}/i', 'max:22', Rule::unique('admins')->ignore(auth()->user()->id)],
            'username' => ['required', 'string', 'max:20', Rule::unique('admins')->ignore(auth()->user()->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore(auth()->user()->id)],
        ]);

        Admin::find(auth()->user()->id)->update([
            'name' => $request->name,
            'nip' => str_replace(array('.', ' '), '', $request->nip),
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return back()->with('message', ['title' => 'Perubahan berhasil disimpan.', 'icon' => 'success']);
    }

    public function simpanSandiBaru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['bail', 'required', new MatchOldPassword],
            'new_password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Admin::find(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('message', ['title' => 'Kata sandi berhasil diubah.', 'icon' => 'success']);
    }

    public function formTambahAdmin()
    {
        return view("admin.pengaturan.admin.tambah", ['tipe_surat' => JenisSurat::all()]);
    }

    public function tambahAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nip' => 'required|string|min:18|max:22|regex:/[0-9]{18}|[0-9]{8}.[0-9]{6}.[1|2]{1}.[0-9]{3}|[0-9]{8} [0-9]{6} [1|2]{1} [0-9]{3}|[0-9]{18}/i|unique:admins',
            'username' => 'required|string|max:20|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
        ])->validate();
        $password = sprintf("%08d", mt_rand(1, 99999999));
        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'nip' => str_replace(array('.', ' '), '', $request->nip),
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        return redirect()->route('pengaturan.admin.index')->with('message', ['modal' => true, 'title' => "Sukses", 'icon' => 'success', 'text' => "Admin {$admin->name} berhasil ditambahkan. Mohon untuk mencatat kata sandi yang akan diberikan, karena hanya muncul sekali saja. Kata sandi: <strong>{$password}</strong>"]);
    }

    public function resetPassword($id)
    {
        $newPassword = sprintf("%08d", mt_rand(1, 99999999));
        $admin = Admin::find($id);
        $admin->update([
            'password' => Hash::make($newPassword),
        ]);

        return response()->json(['password' => $newPassword], 200);
    }

    public function hapusAdmin($id)
    {
        try {
            $admin = Admin::find($id);

            if ($admin) {
                $admin->delete();

                return response()->json(['content' => "Admin bernama {$admin->name} berhasil dihapus"], 200);
            }

            return response()->json(['content' => "Admin tidak ditemukan."], 404);
        } catch (\Throwable $th) {
            return response()->json(['content' => $th], 500);
        }
    }
}
