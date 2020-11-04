<?php

use App\Models\Responsible;
use Illuminate\Database\Seeder;

class ResponsibleSeeder extends Seeder
{
    public function run()
    {
        factory(Responsible::class, 1)->create();
    }
}
