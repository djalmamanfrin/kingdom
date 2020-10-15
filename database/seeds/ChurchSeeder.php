<?php

use App\Models\Church;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    public function run()
    {
        factory(Church::class, 30)->create();
    }
}
