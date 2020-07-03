<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
      [
        "name"=>"WiFi"
      ],
      [
        "name"=>"Sauna"
      ],
      [
        "name"=>"Pool"
      ],
      [
        "name"=>"Parking"
      ],
      [
        "name"=>"Seaview"
      ],
      [
        "name"=>"Concierge"
      ]
    ];
});
