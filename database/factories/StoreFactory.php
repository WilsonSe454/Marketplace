<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Store;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'phone' => $faker->phoneNumber,
        'mobile_phone' => $faker->phoneNumber,
        'slug' => $faker->slug,
    ];
});


/* 
    $table->string('name');
    $table->string('description');
    $table->string('phone');
    $table->string('mobile_phone');
    $table->string('slug');
 */