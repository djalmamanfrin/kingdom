<?php

return [
    'get' => [
        [
            'text' => 'Id',
            'value' => 'id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'ID do usuário',
            'value' => 'user_id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'Id do perfil',
            'value' => 'profile_id',
            'description' => 'Cada usuário possue um perfil que pode ser acessado pelo id'
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
            'text' => 'Atualizado Em',
            'value' => 'updated_at',
            'description' => 'Data em que o registro foi atualizado'
        ],
        [
            'text' => 'Criado Em',
            'value' => 'created_at',
            'description' => 'Data em que o registro foi criado'
        ]
    ]
];
