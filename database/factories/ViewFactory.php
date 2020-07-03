<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\View;
use Faker\Generator as Faker;

$factory->define(View::class, function (Faker $faker) {
    return [
        "ip_address"=>$faker->ipv4(),
        "view_date"=>$faker->date()
    ];
});
