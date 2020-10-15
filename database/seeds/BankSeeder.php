<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    public function run()
    {
        DB::table('bank')->insert([
            ['cod' => '001', 'name' => 'BANCO DO BRASIL S.A (BB)', 'ispb' => '00000000'],
            ['cod' => '237', 'name' => 'BRADESCO S.A', 'ispb' => '60746948'],
            ['cod' => '335', 'name' => 'Banco Digio S.A', 'ispb' => '27098060'],
            ['cod' => '260', 'name' => 'NU PAGAMENTOS S.A (NUBANK)', 'ispb' => '18236120'],
            ['cod' => '290', 'name' => 'Pagseguro Internet S.A', 'ispb' => '08561701'],
            ['cod' => '323', 'name' => 'Mercado Pago - conta do Mercado Livre', 'ispb' => '10573521'],
            ['cod' => '077', 'name' => 'BANCO INTER S.A', 'ispb' => '00416968'],
            ['cod' => '341', 'name' => 'ITAÚ UNIBANCO S.A', 'ispb' => '60701190'],
            ['cod' => '104', 'name' => 'CAIXA ECONÔMICA FEDERAL (CEF)', 'ispb' => '00360305'],
            ['cod' => '033', 'name' => 'BANCO SANTANDER BRASIL S.A', 'ispb' => '90400888'],
            ['cod' => '212', 'name' => 'BANCO ORIGINAL S.A', 'ispb' => '92894922'],
            ['cod' => '655', 'name' => 'BANCO VOTORANTIM S.A', 'ispb' => '59588111'],
            ['cod' => '655', 'name' => 'NEON PAGAMENTOS S.A (OS MESMOS DADOS DO BANCO VOTORANTIM)', 'ispb' => '59588111'],
            ['cod' => '041', 'name' => 'BANRISUL – BANCO DO ESTADO DO RIO GRANDE DO SUL S.A', 'ispb' => '92702067'],
            ['cod' => '070', 'name' => 'BANCO DE BRASÍLIA (BRB)', 'ispb' => '00000208'],
            ['cod' => '748', 'name' => 'SICREDI S.A', 'ispb' => '01181521'],
            ['cod' => '102', 'name' => 'XP INVESTIMENTOS S.A', 'ispb' => '02332886'],
            ['cod' => '348', 'name' => 'BANCO XP S/A', 'ispb' => '33264668'],
            ['cod' => '062', 'name' => 'HIPERCARD BM S.A', 'ispb' => '03012230'],
            ['cod' => '003', 'name' => 'BANCO DA AMAZONIA S.A', 'ispb' => '04902979'],
            ['cod' => '037', 'name' => 'BANCO DO ESTADO DO PARÁ S.A', 'ispb' => '04913711'],
            ['cod' => '254', 'name' => 'PARANA BANCO S.A', 'ispb' => '14388334'],
            ['cod' => '184', 'name' => 'BANCO ITAÚ BBA S.A', 'ispb' => '17298092'],
            ['cod' => '746', 'name' => 'BANCO MODAL S.A', 'ispb' => '30723886'],
            ['cod' => '477', 'name' => 'CITIBANK N.A', 'ispb' => '33042953'],
            ['cod' => '745', 'name' => 'BANCO CITIBANK S.A', 'ispb' => '33479023'],
            ['cod' => '007', 'name' => 'BNDES (Banco Nacional do Desenvolvimento Social)', 'ispb' => '33657248'],
            ['cod' => '029', 'name' => 'BANCO ITAÚ CONSIGNADO S.A', 'ispb' => '33885724'],
            ['cod' => '269', 'name' => 'HSBC BANCO DE INVESTIMENTO', 'ispb' => '53518684'],
            ['cod' => '479', 'name' => 'BANCO ITAUBANK S.A', 'ispb' => '60394079'],
            ['cod' => '652', 'name' => 'ITAÚ UNIBANCO HOLDING BM S.A', 'ispb' => '60872504'],
            ['cod' => '249', 'name' => 'BANCO INVESTCRED UNIBANCO S.A', 'ispb' => '61182408'],
            ['cod' => '177', 'name' => 'GUIDE', 'ispb' => '65913436'],
        ]);
    }
}
