<?php

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
            'description' => 'Número identificador do dono do cartão na base de dados'
        ],
        [
            'text' => 'ID da banderia',
            'value' => 'brand_id',
            'description' => 'Número identificador da bandeira do cartão na base de dados'
        ],
        [
            'text' => 'Proprietário do Cartão',
            'value' => 'owner',
            'description' => 'Nome completo informado no cartão'
        ],
        [
            'text' => 'Número do cartão',
            'value' => 'number',
            'description' => 'Número identificador informado no cartão'
        ],
        [
            'text' => 'Mês de expiração',
            'value' => 'expiry_month',
            'description' => 'Mês de expiração informado no cartão'
        ],
        [
            'text' => 'Ano de expiração',
            'value' => 'expiry_year',
            'description' => 'Ano de expiração informado no cartão'
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
