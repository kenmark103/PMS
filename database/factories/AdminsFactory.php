<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Admins;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Admins::class, function (Faker $faker) {
  static $password;
    return [
      'name' => $faker->name,
      'email' => $faker->unique()->lastName.'@admin.pms.com',
      'phonenumber'=>random_int(0700207435,0700207666),
      'password' => $password ?: $password = bcrypt('secret'),
      'roles_id' => 2,
    ];
});
