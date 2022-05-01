<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Surat;
use Faker\Generator as Faker;

$factory->define(Surat::class, function (Faker $faker) {
    return [
        'nomor_surat'       => $faker->numerify(),
        'jenis_surat'       => $faker->uuid(),
        'pemohon'           => $faker->numerify("120402####"),
        'surat'             => $faker->uuid(),
        'status_surat'      => "Belum Diproses",
        'tanggal_terbit'    => $faker->date()
    ];
});

$factory->state(Surat::class, 'belum_diproses', function (Faker $faker) {
    return [
        'status_surat'      => "Belum Diproses"
    ];
});

$factory->state(Surat::class, "telah_diproses", function (Faker $faker) {
    return [
        'status_surat'      => "Telah Diproses"
    ];
});
