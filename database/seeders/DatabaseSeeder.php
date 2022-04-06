<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PeopleTableSeeder;
use Database\Seeders\RestdataTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PeopleTableSeeder::class);
        $this->call(RestdataTableSeeder::class);
    }
}
