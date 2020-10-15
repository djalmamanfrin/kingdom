<?php

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    public function run()
    {
        factory(BankAccount::class, 30)->create();
    }
}
