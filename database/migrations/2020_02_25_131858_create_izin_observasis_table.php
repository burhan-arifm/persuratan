<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinObservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_observasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lokasi_observasi');
            $table->text('alamat_lokasi');
            $table->string('kota_lokasi');
            $table->string('topik_skripsi');
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
        Schema::dropIfExists('izin_observasis');
    }
}
