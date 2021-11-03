<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->integer('nim');
            $table->string('nama');
            $table->string('tempat_tanggal_lahir')->nullable($value = true);
            $table->char('program_studi', 3);
            $table->text('alamat');
            $table->string('pembimbing_studi')->nullable($value = true);
            $table->timestamps();

            $table->primary('nim'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
}
