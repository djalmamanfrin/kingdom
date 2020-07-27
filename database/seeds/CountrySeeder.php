<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        DB::table("country")->insert([
            [
                "name" => "Brasil",
                "locale" => "pt_BR",
                "code" => "BRA",
                "language" =>"pt-BR",
                "phone_code" => "+55"
            ],
            [
                "name" => "Estados Unidos",
                "locale" => "un_US",
                "code" => "USA",
                "language" =>"en-US",
                "phone_code" => "+1"
            ],
            [
                "name" => "Portugal",
                "locale" => "pt_PT",
                "code" => "PRT",
                "language" =>"pt-PT",
                "phone_code" => "+351"
            ]
        ]);
    }
}
