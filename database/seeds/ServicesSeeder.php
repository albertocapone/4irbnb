<?php

use Illuminate\Database\Seeder;
use App\House;
use App\Service;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Service::class,6)->create()->each(function($service){
        //   $house=House::inRandomOrder()->take(rand(1,100))->get();
        //   $service->houses()->attach($house);
        // });
        $houses =App\House::all();

        App\Service::all()->each(function($service) use($houses){
          $service->houses()->attach(
            $houses->random(rand(1,100))->pluck('id')->toArray()
          );
        });
    }
}
