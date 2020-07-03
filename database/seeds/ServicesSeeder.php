<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\House;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Service::class,6)->create()->each(function($service){
          $house=House::inRandomOrder()-> take(rand(1,6)) -> get();
          $service->houses()->attach($house);
        })
    }
}
