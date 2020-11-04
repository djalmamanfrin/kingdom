<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password,
        'is_admin' => $faker->boolean(500),
        'rg' => $faker->numerify('#########'),
        'cpf' => $faker->numerify('###########')
    ];
});

$factory->define(\App\Models\Member::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class, 1)->create()->get(0)->id,
    ];
});

$factory->define(\App\Models\Entrepreneur::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class, 1)->create()->get(0)->id,
    ];
});

$factory->define(\App\Models\Responsible::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class, 1)->create()->get(0)->id,
    ];
});

$factory->define(\App\Models\State::class, function (Faker $faker) {
    return [
        'name' => $faker->state,
        'country_id' => $faker->randomElement([1, 2, 3]),
        'code' => $faker->stateAbbr,
    ];
});

$factory->define(\App\Models\City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'state_id' => \App\Models\State::pluck('id')->random()
    ];
});

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'city_id' => \App\Models\City::pluck('id')->random(),
        'street' => $faker->streetName,
        'number' => $faker->numerify('#####'),
        'zipcode' => $faker->postcode,
        'observation' => $faker->text(45)
    ];
});

$factory->define(\App\Models\Branch::class, function (Faker $faker) {
    return [
        'responsible_id' => \App\Models\Responsible::pluck('id')->random(),
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'site' => 'https://xpto.com.br'
    ];
});

$factory->define(\App\Models\BankAccount::class, function (Faker $faker) {
    $cnpj = $faker->unique()->bothify('########0001##');
    $cpf =  $faker->unique()->bothify('###########');
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'bank_id' => \App\Models\Bank::pluck('id')->random(),
        'nickname' => $faker->firstName,
        'document' => $faker->randomElement([$cnpj, $cpf]),
        'agency' => $faker->numerify('####-#'),
        'account' => $faker->bankAccountNumber,
        'type' => $faker->randomElement([1, 2])
    ];
});

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'name' => $faker->firstName,
        'description' => implode('. ', $faker->paragraphs($qtd))
    ];
});

$factory->define(\App\Models\Church::class, function (Faker $faker) {
    return [
        'branch_id' => \App\Models\Branch::pluck('id')->random(),
        'address_id' => factory(\App\Models\Address::class, 1)->create()->get(0)->id,
        'name' => $faker->company,
        'cnpj' => $faker->unique()->numerify('########0001##')
    ];
});

$factory->define(\App\Models\Company::class, function (Faker $faker) {
    return [
        'entrepreneur_id' => \App\Models\Entrepreneur::pluck('id')->random(),
        'category_id' => \App\Models\Category::pluck('id')->random(),
        'address_id' => factory(\App\Models\Address::class, 1)->create()->get(0)->id,
        'name' => $faker->company,
        'cnpj' => $faker->unique()->numerify('########0001##')
    ];
});

$factory->define(\App\Models\Brand::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    $brands = [
        'mastercard débito',
        'mastercard crédito',
        'mastercard débito/crédito',
        'visa débito',
        'visa crédito',
        'visa débito/crédito'
    ];
    return [
        'name' => $faker->randomElement($brands),
        'description' => implode('. ', $faker->paragraphs($qtd))
    ];
});

$factory->define(\App\Models\BankCard::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'brand_id' => \App\Models\Brand::pluck('id')->random(),
        'owner' => $faker->name,
        'number' => $faker->creditCardNumber,
        'expiry_month' => $faker->randomElement(['01', '02', '03', '04', '05']),
        'expiry_year' => $faker->randomElement(['2021', '2022', '2023', '2024', '2025'])
    ];
});

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'uuid' => $faker->uuid,
    ];
});

$factory->define(\App\Models\Delivery::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'order_id' => \App\Models\Order::pluck('id')->random(),
        'address_id' => \App\Models\Address::pluck('id')->random(),
        'description' => implode('. ', $faker->paragraphs($qtd)),
        'delivery_at' => $faker->date(),
    ];
});

$factory->define(\App\Models\ProjectType::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'name' => $faker->text(45),
        'description' => implode('. ', $faker->paragraphs($qtd)),
    ];
});

$factory->define(\App\Models\Indication::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'company_id' => \App\Models\Company::pluck('id')->random(),
        'is_active' => $faker->boolean(90),
        'value' => $faker->randomNumber(2),
        'quantity' => $faker->randomNumber(1)
    ];
});

$factory->define(\App\Models\Service::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'company_id' => \App\Models\Company::pluck('id')->random(),
        'is_active' => $faker->boolean(90),
        'name' => $faker->text(45),
        'description' => implode('. ', $faker->paragraphs($qtd))
    ];
});

$factory->define(\App\Models\Item::class, function (Faker $faker) {
    return [
        'order_id' => \App\Models\Order::pluck('id')->random(),
        'product_id' => \App\Models\Product::pluck('id')->random(),
        'quantity' => $faker->randomNumber(1)
    ];
});

$factory->define(\App\Models\NotificationType::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'name' => $faker->name,
        'description' => implode('. ', $faker->paragraphs($qtd)),
    ];
});

$factory->define(\App\Models\Notification::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'notification_type_id' =>\App\Models\NotificationType::pluck('id')->random(),
        'title' => $faker->name,
        'description' => implode('. ', $faker->paragraphs($qtd)),
        'is_read' => $faker->boolean(50),
    ];
});

$factory->define(\App\Models\Transaction::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'order_id' => \App\Models\Order::pluck('id')->random(),
        'bank_card_id' => \App\Models\BankAccount::pluck('id')->random(),
        'currency_id' => $faker->randomElement([1, 2, 3]),
        'value' => $faker->randomNumber(2),
        'discount' => $faker->randomNumber(2)
    ];
});

$factory->define(\App\Models\Phone::class, function (Faker $faker) {
    $prefix = $faker->randomElement([41, 11, 48]);
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'country_id' => $faker->randomElement([1, 2, 3]),
        'number' => $faker->numerify($prefix . '9########')
    ];
});

$factory->define(\App\Models\Project::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'branch_id' => \App\Models\Branch::pluck('id')->random(),
        'project_type_id' => \App\Models\ProjectType::pluck('id')->random(),
        'title' => $faker->name,
        'description' => implode('. ', $faker->paragraphs($qtd)),
        'delivery_at' => $faker->date(),
        'expected_at' => $faker->date(),
    ];
});

$factory->define(\App\Models\ProjectItem::class, function (Faker $faker) {
    return [
        'project_id' => \App\Models\Project::pluck('id')->random(),
        'product_id' => \App\Models\Product::pluck('id')->random(),
    ];
});

$factory->define(\App\Models\Wishlist::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::pluck('id')->random(),
        'service_id' => \App\Models\Service::pluck('id')->random(),
    ];
});
