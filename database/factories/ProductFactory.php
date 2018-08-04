<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title'        =>  $faker->text('50'),
        'description'  =>  $faker->text('200'),
        'image'        =>  'product.jpeg',
        'slug'         =>  $faker->slug(),
        'price'        =>  $faker->randomFloat(NULL, 0,10000),
        'quantity'     =>  $faker->numberBetween(10,100),
        'category'     =>  1,
    ];
});