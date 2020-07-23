<?php

use Illuminate\Database\Seeder;
use App\View;
use App\House;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(View::class,1500)->make()->each(function($view){
          $house=House::inRandomOrder()->first();
          $view->house()->associate($house);
          $view->save();
        });
    }
}
