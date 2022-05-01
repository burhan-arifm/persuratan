<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobTraining;
use Faker\Generator as Faker;

$factory->define(JobTraining::class, function (Faker $faker) {
    return [
        'instansi_penerima' => $faker->company(),
        'alamat_instansi'   => $faker->streetAddress(),
        'kota_lokasi'       => $faker->city(),
        'dosen_pembimbing'  => $faker->name()
    ];
});
