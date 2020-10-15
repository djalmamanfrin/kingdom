<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run()
    {
        factory(State::class, 30)->create();
    }
}
