<?php

use App\Models\BankCard;
use Illuminate\Database\Seeder;

class BankCardSeeder extends Seeder
{
    public function run()
    {
        factory(BankCard::class, 10)->create();
    }
}
