<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        factory(City::class, 30)->create();
    }
}
