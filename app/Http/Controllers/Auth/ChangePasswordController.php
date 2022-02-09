<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->with('message', ['title' => $validator->errors(), 'icon' => 'error'])->withInput();
        }

        Admin::find(\auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('message', ['title' => 'Kata sandi berhasil diubah.', 'icon' => 'success']);
    }
}
