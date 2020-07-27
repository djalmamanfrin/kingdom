<?php

use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    public function run()
    {
        factory(Phone::class, 10)->create();
    }
}
