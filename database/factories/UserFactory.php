<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
  static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phonenumber'=>random_int(1001675945, 1008674587),
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('zxcvbnm,.'), // password
        'remember_token' => Str::random(10),
    ];
});
