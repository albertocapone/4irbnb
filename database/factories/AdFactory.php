<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
          [
            'name' => 'Standard',
            'price' => 2.99,
            'duration' => '24h'
        ],
        [
            'name' => 'Medium',
            'price' => 5.99,
            'duration' => '48h'
        ],
        [
            'name' => 'Premium',
            'price' => 9.99,
            'duration' => '72h'
        ]
    ];
});
