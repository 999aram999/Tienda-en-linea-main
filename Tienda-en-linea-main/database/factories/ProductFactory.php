<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'code'=>$faker->ean8,
        'name'=>$faker->StreetName,
        'slug'=>$faker->unique()->slug,
        'stock'=>$faker->buildingNumber,
        'short_description'=>$faker->sentence($nbWords=6,$variableNbWords=true),
        'long_description'=>$faker->sentence($nbWords=6,$variableNbWords=true),
        'sell_price'=>$faker->randomNumber(2),
        'cred_price'=>$faker->randomNumber(2),
        'status'=>'ACTIVE',
        'subcategory_id'=>rand(1,10),
        
    ];
});
