<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\House;
use Faker\Generator as Faker;
use Spatie\Geocoder\Geocoder;

$factory->define(House::class, function (Faker $faker) {

  $client = new \GuzzleHttp\Client();

  $geocoder = new Geocoder($client);

  $geocoder->setApiKey(config('geocoder.key'));

  $latlng = [
    "lat" => $faker->latitude($min = 35, $max = 47),
    "lng" => $faker->longitude($min = 6, $max = 18),
  ];

  $address = $geocoder->getAddressForCoordinates($latlng["lat"], $latlng["lng"]);

    return [
      "title"=>$faker->word(),
      "description"=>$faker->sentence(),
      "rooms"=>rand(1,10),
      "beds"=>rand(1,20),
      "bathrooms"=>rand(1,10),
      "sqm"=>rand(5,500),
      "address" => $address["formatted_address"],
      "lat"=>$latlng["lat"],
      "lng"=> $latlng["lng"],
      "house_img"=> "https://www.domusweb.it/content/domusweb20/en/architecture/archive/2017/07/03/straw_bale_house/jcr:content/image-preview.img.rmedium.jpg/1499154280967.jpg",
      "visibility"=>$faker->boolean()
    ];
});
