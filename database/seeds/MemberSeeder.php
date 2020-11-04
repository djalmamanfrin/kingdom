<?php

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        factory(Member::class, 30)->create();
    }
}
