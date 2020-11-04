<?php

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run()
    {
        factory(Branch::class, 10)->create();
    }
}
