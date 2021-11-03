<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_surats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_surat')->unique();
            $table->string('jenis_surat');
            $table->string('perihal');
            $table->string('atas_nama');
            $table->string('penanda_tangan');
            $table->string('nip_penanda_tangan');
            $table->string('jabatan_penanda_tangan');
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
        Schema::dropIfExists('jenis_surats');
    }
}
