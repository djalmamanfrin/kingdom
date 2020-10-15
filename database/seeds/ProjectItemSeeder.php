<?php

use App\Models\ProjectItem;
use Illuminate\Database\Seeder;

class ProjectItemSeeder extends Seeder
{
    public function run()
    {
        factory(ProjectItem::class, 30)->create();
    }
}
