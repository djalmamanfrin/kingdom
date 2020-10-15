<?php

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
            'text' => 'Tipo do projeto',
            'value' => 'type',
            'description' => 'Categoria em que o projeto foi especificado'
        ],
        [
            'text' => 'Título',
            'value' => 'title',
            'description' => 'Breve descrição em apenas uma frase do que refere-se o projeto'
        ],
        [
            'text' => 'Descrição',
            'value' => 'description',
            'description' => 'Descrição detalhada do que refere-se o projeto'
        ],
        [
            'text' => 'Data de conclusão',
            'value' => 'delivery_at',
            'description' => 'Data da conclusão do projetos. Todas as sementes foram alcançadas'
        ],
        [
            'text' => 'Data prevista de conclusão',
            'value' => 'expected_at',
            'description' => 'Data prevista para a conclusão do projetos em que todas as sementes serão alcançadas'
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
    'type' => [
        [
            'text' => 'Id',
            'value' => 'id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'Título',
            'value' => 'name',
            'description' => 'Breve descrição em apenas uma frase do que refere-se o projeto'
        ],
        [
            'text' => 'Descrição',
            'value' => 'description',
            'description' => 'Descrição detalhada do que refere-se o projeto'
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
    'products' => [
        [
            'text' => 'Id',
            'value' => 'id',
            'description' => 'Número identificador na base de dados'
        ],
        [
            'text' => 'Serviço?',
            'value' => 'is_service',
            'description' => 'Sim: item cadastrado é um serviço; Não: item cadastrado é um produto'
        ],
        [
            'text' => 'Tipo',
            'value' => 'category',
            'description' => 'Categoria em que o produto foi especificado'
        ],
        [
            'text' => 'Valor R$',
            'value' => 'value',
            'description' => 'Valor monetário para adquirir o produto'
        ],
        [
            'text' => 'Em estoque',
            'value' => 'quantity',
            'description' => 'Quantidade de item em estoque para ser comercializado'
        ],
        [
            'text' => 'Ativo',
            'value' => 'is_active',
            'description' => 'Sim: item está sendo comercializado; Não: item NÂO está sendo comercializado'
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
    ]
];
