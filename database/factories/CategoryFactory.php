<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'slug' => $faker->slug,
    ];
});


/* 
    $table->string('name');
    $table->string('description')->nullable();
    $table->string('slug');
*/