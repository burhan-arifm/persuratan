<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinPraktiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_praktiks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instansi_penerima');
            $table->text('alamat_instansi');
            $table->string('kota_lokasi');
            $table->string('mata_kuliah');
            $table->string('dosen_pengampu');
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
        Schema::dropIfExists('izin_praktiks');
    }
}
