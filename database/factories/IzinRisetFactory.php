<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IzinRiset;
use Faker\Generator as Faker;

$factory->define(IzinRiset::class, function (Faker $faker) {
    return [
        'lokasi_riset'  => $faker->company(),
        'alamat_lokasi' => $faker->streetAddress(),
        'kota_lokasi'   => $faker->city(),
        'judul_skripsi' => $faker->sentence(8),
        'pembimbing_1'  => $faker->name(),
        'pembimbing_2'  => $faker->name()
    ];
});
