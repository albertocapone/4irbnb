<?php

use Illuminate\Database\Seeder;
use App\House;
use App\Ad;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //   factory(Ad::class,3)->create()->each(function($ad){
    //       $house = House::inRandomOrder()->take(rand(0,8))->get();
    //       $ad-> houses() -> attach($house);
    //   });
    $houses =App\House::all();

      App\Ad::all()->each(function($ad) use($houses){
        $ad->houses()->attach(
        $houses->random(rand(1,15))->pluck('id')->toArray()
        );
      });
    }
}
