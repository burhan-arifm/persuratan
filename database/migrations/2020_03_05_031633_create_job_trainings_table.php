<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instansi_penerima');
            $table->text('alamat_instansi');
            $table->string('kota_lokasi');
            $table->string('dosen_pembimbing');
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
        Schema::dropIfExists('job_trainings');
    }
}
