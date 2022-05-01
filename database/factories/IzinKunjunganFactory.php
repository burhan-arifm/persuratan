<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IzinKunjungan;
use Faker\Generator as Faker;
use HnhDigital\LaravelNumberConverter\Facade as NumConvert;

$factory->define(IzinKunjungan::class, function (Faker $faker) {
    return [
        'instansi_penerima' => $faker->company(),
        'alamat_instansi'   => $faker->streetAddress(),
        'kota_instansi'     => $faker->city(),
        'mata_kuliah'       => $faker->sentence(3),
        'program_studi'     => $faker->uuid(),
        'semester'          => NumConvert::roman($faker->numberBetween(1, 8)),
        'kelas'             => $faker->randomElement(['A', 'B', 'C', 'D']),
        'dosen_pengampu'    => $faker->name(),
        'tanggal_kunjungan' => $faker->date(),
        'waktu_kunjungan'   => $faker->time('H:i')
    ];
});
