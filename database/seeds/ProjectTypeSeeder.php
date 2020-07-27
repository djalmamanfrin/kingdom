<?php

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    public function run()
    {
        factory(ProjectType::class, 10)->create();
    }
}
