<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subcategory;
use Faker\Generator as Faker;

$factory->define(Subcategory::class, function (Faker $faker) {
    return [
        'category_id'=>rand(1,10),
        'slug'=>$faker->unique()->slug,
        'name'=>$faker->unique()->word,
        'description'=>$faker->sentence($nbWords=6, $variableNbWords= true),
    ];

    
});
