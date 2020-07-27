<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_type')->insert([
            [
                'name' => 'client',
                'description' => 'Perfil responsável por comprar na aplicação. Poderá solicitar a troca do perfil para seller'
            ],
            [
                'name' => 'seller',
                'description' => 'Perfil responsável por comprar e vender na aplicação. Poderá cadastrar e divulgar
                    produtos e serviços'
            ],
            [
                'name' => 'responsible',
                'description' => 'Perfil responsável por comprar, vender e cadastrar igrejas. Além de poder cadastrar
                    cadastrar produtos e serviços, poderá cadastar uma ou mais igrejas. Para o usuário ter este perfil
                    necesita ser o pastor responsável pela igreja'
            ]
        ]);
    }
}
