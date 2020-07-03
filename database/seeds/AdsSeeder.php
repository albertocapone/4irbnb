<?php

use Illuminate\Database\Seeder;
use App\Ad;
use App\House;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Ad::class, 100)->create()->each(function($ad)
      {
          $house = House::inRandomOrder()->first();
          $ad-> houses() -> attach($house);
      });
    }
}
