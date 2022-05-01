<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IzinObservasi;
use Faker\Generator as Faker;

$factory->define(IzinObservasi::class, function (Faker $faker) {
    return [
        'lokasi_observasi'  => $faker->company(),
        'alamat_lokasi'     => $faker->streetAddress(),
        'kota_lokasi'       => $faker->city(),
        'topik_skripsi'     => $faker->sentence(8)
    ];
});
