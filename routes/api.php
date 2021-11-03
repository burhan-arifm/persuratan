<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'data-surat', 'as' => 'data_surat.'], function ()
{
    Route::get('semua', 'SuratController@semua')->name('semua');
    Route::get('terbaru', 'SuratController@terbaru')->name('terbaru');
});
