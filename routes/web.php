<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'login'], function () {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', 'AdminController@login');
});
Route::post('logout', 'AdminController@logout')->name('logout');

Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
    Route::get('/', 'SuratController@daftarFormPengajuan')->name('index');
    Route::get('{kode_surat}', 'SuratController@formPengajuan')->name('form_surat');
    Route::post('{kode_surat}', 'SuratController@ajukan')->name('ajukan_surat');
});

Route::middleware('auth')->group(function () {
    Route::get('/', 'AdminController@homeDashboard')->name('beranda');
    Route::group(['prefix' => 'surat', 'as' => 'surat.'], function () {
        Route::get('/', 'SuratController@semua')->name('riwayat');
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', 'SuratController@detail')->name('detail');
            Route::get('cetak', 'SuratController@cetak')->name('cetak');
            Route::get('sunting', 'SuratController@formSunting')->name('sunting');
            Route::put('sunting', 'SuratController@sunting')->name('edit');
            Route::delete('/', 'SuratController@hapus')->name('hapus');
        });
    });
    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::get('/', 'AdminController@laporan')->name('umum');
    });
    Route::group(['prefix' => 'pengaturan', 'as' => 'pengaturan.'], function () {
        Route::name('surat.')->group(function () {
            Route::get('surat/{kode_surat}', 'SuratController@pengaturanSurat')->name('buka');
            Route::put('surat/{kode_surat}', 'SuratController@simpanPengaturan')->name('simpan');
        });
        Route::group(['prefix' => 'akun', 'as' => 'akun.'], function () {
            Route::get('/', 'AdminController@pengaturanAkun')->name('buka');
            Route::put('/', 'AdminController@simpanPengaturan')->name('simpan-akun');
            Route::put('ubah-sandi', 'AdminController@simpanSandiBaru')->name('ganti-sandi');
        });
        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
            Route::get('/', 'AdminController@pengaturanAdmin')->name('index');
            Route::get('/tambah', 'AdminController@formTambahAdmin')->name('formTambah');
            Route::post('/tambah', 'AdminController@tambahAdmin')->name('tambah');
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/password-reset', 'AdminController@resetPassword')->name('reset');
                Route::delete('/', 'AdminController@hapusAdmin')->name('hapus');
            });
        });
    });
});
