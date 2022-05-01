<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'nip' => "{$faker->date('Ymd')}{$faker->date('Ym')}{$faker->numberBetween(1, 2)}{$faker->numerify('0##')}",
        'username' => $faker->userName(),
        'email' => $faker->unique()->safeEmail(),
        'password' => $faker->password(),
        'is_admin' => false,
        'remember_token' => Str::random(10),
    ];
});

$factory->state(Admin::class, 'superadmin', function () {
    return [
        'is_admin' => true
    ];
});
