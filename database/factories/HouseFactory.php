<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\House;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    return [
      "title"=>$faker->word(),
      "description"=>$faker->sentence(),
      "rooms"=>rand(1,10),
      "beds"=>rand(1,20),
      "bathrooms"=>rand(1,10),
      "sqm"=>rand(5,500),
      "address"=>$faker->address(),
      "lat"=>$faker->latitude($min = 35, $max = 47),
      "lng"=>$faker->longitude($min = 6, $max = 18),
      "house_img"=> "https://www.domusweb.it/content/domusweb20/en/architecture/archive/2017/07/03/straw_bale_house/jcr:content/image-preview.img.rmedium.jpg/1499154280967.jpg",
      "visibility"=>$faker->boolean()
    ];
});
