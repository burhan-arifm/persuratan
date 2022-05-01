<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mahasiswa;
use Faker\Generator as Faker;

$factory->define(Mahasiswa::class, function (Faker $faker) {
    return [
        'nim' => $faker->numerify("120402####"),
        'nama' => $faker->name(),
        'program_studi' => $faker->uuid(),
        'alamat' => $faker->address()
    ];
});
