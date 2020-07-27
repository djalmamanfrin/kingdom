<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        DB::table('currency')->insert([
            ['name' => 'Real', 'symbol' => 'BRL', 'code' => 'R$'],
            ['name' => 'Dollar', 'symbol' => 'BRL', 'code' => '$'],
            ['name' => 'Euro', 'symbol' => 'BRL', 'code' => '€']
        ]);
    }
}
