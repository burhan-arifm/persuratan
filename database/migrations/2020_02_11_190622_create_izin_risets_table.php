<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinRisetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_risets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lokasi_riset');
            $table->text('alamat_lokasi');
            $table->string('kota_lokasi');
            $table->string('judul_skripsi');
            $table->string('pembimbing_1');
            $table->string('pembimbing_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izin_risets');
    }
}
