<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\House;


class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Message::class,328) ->make() -> each(function($message) {
        $house =House::inRandomOrder() ->first();
        $message -> house() -> associate($house);
        $message -> save();
      });
    }
}
