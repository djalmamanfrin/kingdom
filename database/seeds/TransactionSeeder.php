<?php

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        factory(Transaction::class, 30)->create();
    }
}
