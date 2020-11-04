<?php

use App\Models\Entrepreneur;
use Illuminate\Database\Seeder;

class EntrepreneurSeeder extends Seeder
{
    public function run()
    {
        factory(Entrepreneur::class, 1)->create();
    }
}
