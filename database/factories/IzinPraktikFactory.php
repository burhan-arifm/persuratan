<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IzinPraktik;
use Faker\Generator as Faker;

$factory->define(IzinPraktik::class, function (Faker $faker) {
    return [
        'instansi_penerima' => $faker->company(),
        'alamat_instansi'   => $faker->streetAddress(),
        'kota_lokasi'       => $faker->city(),
        'mata_kuliah'       => $faker->sentence(3),
        'dosen_pengampu'    => $faker->name(),
    ];
});
