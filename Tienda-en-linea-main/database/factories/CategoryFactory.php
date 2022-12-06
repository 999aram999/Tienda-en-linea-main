<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->name,
        'slug'=>$faker->unique()->slug,
        'description'=>$faker->sentence($nbWords=6, $variableNbWords= true),
        'icon'=>$faker->randomElement(['icon-fruits',
    'icon-broccoli',
    'icon-beef',
    'icon-fish']),

        //
    ];
});
