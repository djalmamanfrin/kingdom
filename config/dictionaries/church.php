<?php

$address = include 'address.php';
unset($address['get'][1]); // remove o dict 'value' => 'user_id',
return [
    'get' => [
        [
            'text' => 'Id',
            'value' => 'id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'ID da Matriz',
            'value' => 'branch_id',
            'description' => 'Documento único de identificação pessoal'
        ],
        [
            'text' => 'Nome da Igreja',
            'value' => 'name',
            'description' => 'Nome fantasia da igreja'
        ],
        [
            'text' => 'CNPJ',
            'value' => 'cnpj',
            'description' => 'Cadastro nacional de pessoa juridica'
        ],
        [
            'text' => 'Atualizado Em',
            'value' => 'updated_at',
            'description' => 'Data em que o registro foi atualizado'
        ],
        [
            'text' => 'Criado Em',
            'value' => 'created_at',
            'description' => 'Data em que o registro foi criado'
        ]
    ],
    'address' => $address['get']
];
