<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        factory(Brand::class, 10)->create();
    }
}
