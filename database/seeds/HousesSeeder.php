<?php

use Illuminate\Database\Seeder;
use App\House;
use App\User;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(House::class,10000)
            ->make()->each(function($house){
            $user=User::inRandomOrder()->first();
            $house->user()->associate($user);
            $house->save();
          });

    }
}
