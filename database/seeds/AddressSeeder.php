<?php

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run()
    {
        factory(Address::class, 30)->create();
    }
}
