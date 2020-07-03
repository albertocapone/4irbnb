<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            HousesSeeder::class,
            AdsSeeder::class,
            ServicesSeeder::class,
            MessagesSeeder::class,
            ViewsSeeder::class
        ]);
    }
}
