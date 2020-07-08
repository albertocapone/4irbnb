<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\House;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    return [
      "title"=>$faker->word(),
      "description"=>$faker->sentence(),
      "rooms"=>rand(1,5),
      "beds"=>rand(1,10),
      "bathrooms"=>rand(1,3),
      "sqm"=>rand(40,150),
      "address"=>$faker->address(),
      "lat"=>$faker->latitude($min = 30, $max = 70),
      "lng"=>$faker->longitude($min = -10, $max = 50),
      "img_url"=>$faker->imageurl(),
      "visibility"=>$faker->boolean()
    ];
});
