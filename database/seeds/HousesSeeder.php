<?php

use Illuminate\Database\Seeder;
use App\Ad;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(House::class, 100)->create()->each(function($house){
            $ad = Ad::inRandomOrder()->first();
            $house-> ads() -> attach($ad);
        });
    }
}
