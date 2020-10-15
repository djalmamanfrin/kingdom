<?php

$profile = include 'profile.php';
$branch = include 'branch.php';
$bankCards = include 'bank_cards.php';
$addresses = include 'address.php';
$bankAccounts = include 'bank_accounts.php';
$indications = include 'indications.php';
$notifications = include 'notifications.php';
return [
    'get' => [
        [
            'text' => 'Id',
            'value' => 'id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'Id do perfil',
            'value' => 'profile_id',
            'description' => 'Cada usuário possue um perfil que pode ser acessado pelo id'
        ],
        [
            'text' => 'Perfil',
            'value' => 'profile',
            'description' => 'O tipo do usuário serve para distinguir suas atribuições no sistema'
        ],
        [
            'text' => 'Nome completo',
            'value' => 'name',
            'description' => 'Nome completo do usuário'
        ],
        [
            'text' => 'E-mail',
            'value' => 'email',
            'description' => 'E-mail do usuário para contato, notificações e login no sistema'
        ],
        [
            'text' => 'Está associado a uma Igreja?',
            'value' => 'is_member',
            'description' => 'O campo is_member se verdadeiro demonstra que o usuáro já é membro de uma igreja'
        ],
        [
            'text' => 'Docuemnto RG',
            'value' => 'rg',
            'description' => 'Documento único de identificação pessoal'
        ],
        [
            'text' => 'Docuemnto CPF',
            'value' => 'cpf',
            'description' => 'Documento único de identificação pessoal'
        ],
        [
            'text' => 'Criado Em',
            'value' => 'created_at',
            'description' => 'Data em que o registro foi criado'
        ],
        [
            'text' => 'Atualizado Em',
            'value' => 'updated_at',
            'description' => 'Data em que o registro foi atualizado'
        ]
    ],
    'profile' => $profile['get'],
    'branches' => $branch['get'],
    'bank_cards' => $bankCards['get'],
    'addresses' => $addresses['get'],
    'bank_accounts' => $bankAccounts['get'],
    'indications' => $indications['get'],
    'notifications' => $notifications['get'],
];
