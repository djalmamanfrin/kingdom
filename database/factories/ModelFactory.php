<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'user_type_id' => $faker->randomElement([1, 2, 3]),
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password,
        'is_member' => $faker->boolean(50),
        'rg' => $faker->numerify('#########'),
        'cpf' => $faker->numerify('###########')
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
        'state_id' => factory(\App\Models\State::class)
    ];
});

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class),
        'city_id' => factory(\App\Models\City::class),
        'street' => $faker->streetName,
        'number' => $faker->numerify('#####'),
        'zipcode' => $faker->postcode,
        'observation' => $faker->text(45)
    ];
});

$factory->define(\App\Models\Branch::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class),
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'site' => 'https://xpto.com.br'
    ];
});

$factory->define(\App\Models\BankAccount::class, function (Faker $faker) {
    $numerify = $faker->numerify('########0001##');
    $cnpj = $faker->randomElement([$numerify, null]);
    $cpf =  (is_null($cnpj)) ? $faker->numerify('###########') : null;
    return [
        'user_id' => factory(\App\Models\User::class),
        'name' => $faker->firstName,
        'agency' => $faker->numerify('####-#'),
        'account' => $faker->bankAccountNumber,
        'type' => $faker->randomElement(['conta corrente', 'conta poupança']),
        'cpf' => $cpf,
        'cnpj' => $cnpj
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
        'branch_id' => factory(\App\Models\Brand::class),
        'address_id' => factory(\App\Models\Address::class),
        'name' => $faker->company,
        'cnpj' => $faker->numerify('########0001##')
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
        'user_id' => factory(\App\Models\User::class),
        'brand_id' => factory(\App\Models\Brand::class),
        'owner' => $faker->name,
        'number' => $faker->creditCardNumber,
        'expiry_month' => $faker->randomElement(['01', '02', '03', '04', '05']),
        'expiry_year' => $faker->randomElement(['2021', '2022', '2023', '2024', '2025'])
    ];
});

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class),
        'uuid' => $faker->uuid,
    ];
});

$factory->define(\App\Models\Delivery::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'order_id' => factory(\App\Models\Order::class),
        'address_id' => factory(\App\Models\Address::class),
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
        'user_id' => factory(\App\Models\User::class),
        'user_type_id' => $faker->randomElement([1, 2, 3]),
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\Models\User::class),
        'category_id' => factory(\App\Models\Category::class),
        'is_service' => $faker->boolean(90),
        'is_active' => $faker->boolean(90),
        'value' => $faker->randomNumber(2),
        'quantity' => $faker->randomNumber(1)
    ];
});

$factory->define(\App\Models\Item::class, function (Faker $faker) {
    return [
        'order_id' => factory(\App\Models\Order::class),
        'product_id' => factory(\App\Models\Product::class),
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
        'user_id' => factory(\App\Models\User::class),
        'notification_type_id' => factory(\App\Models\NotificationType::class),
        'title' => $faker->name,
        'description' => implode('. ', $faker->paragraphs($qtd)),
        'is_read' => $faker->boolean(50),
    ];
});

$factory->define(\App\Models\Transaction::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'order_id' => factory(\App\Models\Order::class),
        'bank_card_id' => factory(\App\Models\BankCard::class),
        'currency_id' => $faker->randomElement([1, 2, 3]),
        'value' => $faker->randomNumber(2),
        'discount' => $faker->randomNumber(2)
    ];
});

$factory->define(\App\Models\Phone::class, function (Faker $faker) {
    $prefix = $faker->randomElement([41, 11, 48]);
    return [
        'user_id' => factory(\App\Models\User::class),
        'country_id' => $faker->randomElement([1, 2, 3]),
        'number' => $faker->numerify($prefix . '9########')
    ];
});

$factory->define(\App\Models\Project::class, function (Faker $faker) {
    $qtd = $faker->randomElement([1, 3, 5, 7]);
    return [
        'branch_id' => factory(\App\Models\Branch::class),
        'project_type_id' => factory(\App\Models\ProjectType::class),
        'title' => $faker->name,
        'description' => implode('. ', $faker->paragraphs($qtd)),
        'delivery_at' => $faker->date(),
        'expected_at' => $faker->date(),
    ];
});

$factory->define(\App\Models\ProjectItem::class, function (Faker $faker) {
    return [
        'project_id' => factory(\App\Models\Project::class),
        'product_id' => factory(\App\Models\Product::class),
    ];
});
