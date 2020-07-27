<?php

use App\Models\Delivery;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    public function run()
    {
        factory(Delivery::class, 10)->create();
    }
}
