<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinKunjungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_kunjungans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instansi_penerima');
            $table->text('alamat_instansi');
            $table->string('kota_instansi');
            $table->string('mata_kuliah');
            $table->char('program_studi', 3);
            $table->string('semester', 4);
            $table->char('kelas', 1);
            $table->string('dosen_pengampu');
            $table->date('tanggal_kunjungan');
            $table->time('waktu_kunjungan');
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
        Schema::dropIfExists('izin_kunjungans');
    }
}
