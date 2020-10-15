<?php

use App\Models\Indication;
use Illuminate\Database\Seeder;

class IndicationSeeder extends Seeder
{
    public function run()
    {
        factory(Indication::class, 30)->create();
    }
}
