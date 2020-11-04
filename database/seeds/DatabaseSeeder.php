<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if ('testing' !== getenv('APP_ENV')) {
            return;
        }

        Model::unguard();
        $this->call([
            // BankSeeder::class,
            // ProfileSeeder::class,
            UserSeeder::class,
            MemberSeeder::class,
            EntrepreneurSeeder::class,
            ResponsibleSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            AddressSeeder::class,
            BranchSeeder::class,
            // BankAccountSeeder::class,
            CategorySeeder::class,
            ChurchSeeder::class,
            CompanySeeder::class,
            ServiceSeeder::class,
            // BrandSeeder::class,
            // BankCardSeeder::class,
            // CurrencySeeder::class,
            // OrderSeeder::class,
            // DeliverySeeder::class,
            // ProjectTypeSeeder::class,
            IndicationSeeder::class,
            ProductSeeder::class,
            // ItemSeeder::class,
            NotificationTypeSeeder::class,
            NotificationSeeder::class,
            // TransactionSeeder::class,
            PhoneSeeder::class,
            // ProjectSeeder::class,
            // ProjectItemSeeder::class,
            WishlistSeeder::class
        ]);
        Model::reguard();
    }
}
