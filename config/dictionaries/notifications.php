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
            'description' => 'Número identificador do usuário na base de dados'
        ],
        [
            'text' => 'Id tipo notificação',
            'value' => 'notification_type_id',
            'description' => 'Número identificador do tipo da notificação na base de dados'
        ],
        [
            'text' => 'Título',
            'value' => 'title',
            'description' => 'Texto que descreve em uma palavra a notificação'
        ],
        [
            'text' => 'Descrição',
            'value' => 'description',
            'description' => 'Texto explicativo do título e que descreve a notificação'
        ],
        [
            'text' => 'Visualizado',
            'value' => 'is_read',
            'description' => 'As opções são: SIM para confirma que a notificação foi visualizado pelo usuário; e ' .
                'NÂO que a notificação não foi visualizado pelo usuário'
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
