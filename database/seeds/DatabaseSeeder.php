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
        // $this->call(UsersTableSeeder::class, 10);
        factory(App\User::class,10)->create();
        factory(App\Message::class,50)->create();
    }
}
