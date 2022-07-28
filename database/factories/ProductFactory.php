<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'body' => $faker->paragraph(5, true),// 5 paragrafos e true para retornar como string
        'price' => $faker->randomFloat(2, 10),
        'slug' => $faker->slug,
    ];
});

/* 
    $table->string('name');
    $table->string('description');
    $table->string('body');
    $table->decimal('price', 10, 2);
    $table->string('slug');
*/
