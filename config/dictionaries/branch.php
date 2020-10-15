<?php

$church = include 'church.php';
$project = include 'project.php';
return [
    'get' => [
        [
            'text' => 'Id',
            'value' => 'id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'ID do Usuário',
            'value' => 'user_id',
            'description' => 'Documento único de identificação pessoal'
        ],
        [
            'text' => 'Nome fantasia',
            'value' => 'name',
            'description' => 'Nome fantasia da matriz'
        ],
        [
            'text' => 'E-mail da matriz',
            'value' => 'email',
            'description' => 'E-mail da matriz para contato e notificações'
        ],
        [
            'text' => 'Site',
            'value' => 'site',
            'description' => 'Endereço online da matriz'
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
    'churches' => $church['get'],
    'projects' => $project['get']
];
