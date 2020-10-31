<?php

use Illuminate\Validation\Rule;

return [
    'user' => [
        'fields' => [
            'name' => ['required', 'string'],
            'profile_id' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'rg' => ['required', 'string'],
            'cpf' => ['required', 'string']
        ],
        'messages' => [
            'name.required' => 'The field name must be informed',
            'name.string' => 'The field name must be string',
            'profile_id.required' => 'The field profile_id must be informed',
            'profile_id.numeric' => 'The field profile_id must be numeric',
            'email.required' => 'The field email must be informed',
            'email.string' => 'The field email must be string',
            'email.email' => 'The field email informed is invalid',
            'password.required' => 'The field password must be informed',
            'password.string' => 'The field password must be string',
            'rg.required' => 'The field rg must be informed',
            'rg.string' => 'The field rg must be string',
            'cpf.required' => 'The field cpf must be informed',
            'cpf.string' => 'The field cpf must be string'
        ]
    ],
    'branch' => [
        'fields' => [
            'user_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email']
        ],
        'messages' => [
            'user_id.required' => 'The field profile_id must be informed',
            'user_id.numeric' => 'The field profile_id must be numeric',
            'name.required' => 'The field name must be informed',
            'name.string' => 'The field name must be string',
            'email.required' => 'The field email must be informed',
            'email.string' => 'The field email must be string',
            'email.email' => 'The field email informed is invalid'
        ]
    ],
    'church' => [
        'fields' => [
            'branch_id' => ['required', 'numeric'],
            'address_id' => ['required', 'numeric'],
            'cnpj' => ['required', 'string', 'digits:14'],
        ],
        'messages' => [
            'branch_id.numeric' => 'The field branch_id must be informed',
            'address_id.numeric' => 'The field address_id must be informed',
            'cnpj.string' => 'The field cnpj must be informed',
            'cnpj.digits' => 'The field cnpj length must be fourteen character'
        ]
    ],
    'project' => [
        'fields' => [
            'branch_id' => ['required', 'numeric'],
            'project_type_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'between:5,50'],
        ],
        'messages' => [
            'branch_id.required' => 'The field branch_id must be informed',
            'branch_id.numeric' => 'The field branch_id must be numeric',
            'project_type_id.required' => 'The field project_type_id must be informed',
            'project_type_id.numeric' => 'The field project_type_id must be numeric',
            'title.string' => 'The field title must be informed',
            'title.numeric' => 'The field title must be string',
            'title.between' => 'The field title must have a length between five and fifty characters'
        ]
    ],
    'product' => [
        'fields' => [
            'user_id' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'between:5,50'],
            'description' => ['required', 'string', 'between:10,300'],
        ],
        'messages' => [
            'user_id.required' => 'The field user_id must be informed',
            'user_id.numeric' => 'The field user_id must be numeric',
            'notification_type_id.required' => 'The field notification_type_id must be informed',
            'notification_type_id.numeric' => 'The field notification_type_id must be numeric',
            'title.string' => 'The field title must be informed',
            'title.numeric' => 'The field title must be string',
            'title.between' => 'The field title must have a length between five and fifty character',
            'description.string' => 'The field description must be informed',
            'description.numeric' => 'The field description must be string',
            'description.between' => 'The field description must have a length between ten and three hundred characters'
        ]
    ],
    'category' => [
        'fields' => [
            'name' => ['required', 'string', 'between:5,50'],
            'description' => ['required', 'string', 'between:10,300'],
        ],
        'messages' => [
            'title.string' => 'The field title must be informed',
            'title.numeric' => 'The field title must be string',
            'title.between' => 'The field title must have a length between five and fifty character',
            'description.string' => 'The field description must be informed',
            'description.numeric' => 'The field description must be string',
            'description.between' => 'The field description must have a length between ten and three hundred characters'
        ]
    ],
    'indication' => [
        'fields' => [
            'user_id' => ['required', 'numeric'],
            'profile_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email']
        ],
        'messages' => [
            'user_id.required' => 'The field user_id must be informed',
            'user_id.numeric' => 'The field user_id must be numeric',
            'profile_if.required' => 'The field profile_if must be informed',
            'profile_if.numeric' => 'The field profile_if must be numeric',
            'name.string' => 'The field name must be informed',
            'name.numeric' => 'The field name must be numeric',
            'email.required' => 'The field email must be informed',
            'email.string' => 'The field email must be string',
            'email.email' => 'The field email informed is invalid'
        ]
    ],
    'notification' => [
        'fields' => [
            'user_id' => ['required', 'numeric'],
            'notification_type_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'between:5,50'],
            'description' => ['required', 'string', 'between:10,300'],
        ],
        'messages' => [
            'user_id.required' => 'The field user_id must be informed',
            'user_id.numeric' => 'The field user_id must be numeric',
            'notification_type_id.required' => 'The field notification_type_id must be informed',
            'notification_type_id.numeric' => 'The field notification_type_id must be numeric',
            'title.string' => 'The field title must be informed',
            'title.numeric' => 'The field title must be string',
            'title.between' => 'The field title must have a length between five and fifty character',
            'description.string' => 'The field description must be informed',
            'description.numeric' => 'The field description must be string',
            'description.between' => 'The field description must have a length between ten and three hundred characters'
        ]
    ],
    'bank_account' => [
        'fields' => [
            'user_id' => ['required', 'numeric', 'exists:user,id'],
            'bank_id' => ['required', 'numeric', 'exists:bank,id'],
            'document' => ['required', 'string', 'between:11,14', 'unique:bank_account,document'],
            'agency' => ['required', 'string'],
            'account' => ['required', 'string'],
            'type' => ['required', 'numeric', 'in:1,2'],
        ],
        'messages' => [
            'user_id.required' => 'The field user_id must be informed',
            'user_id.numeric' => 'The field user_id must be numeric',
            'user_id.exists' => 'The field user_id informed not exists',
            'bank_id.required' => 'The field bank_id must be informed',
            'bank_id.numeric' => 'The field bank_id must be numeric',
            'bank_id.exists' => 'The field bank_id informed not exists',
            'document.required' => 'The field document must be informed',
            'document.string' => 'The field document must be string',
            'document.between' => 'The field document must have a length between 11 and 14 character',
            'document.unique' => 'The document field has already been stored',
            'agency.required' => 'The field agency must be informed',
            'agency.string' => 'The field agency must be string',
            'account.required' => 'The field account must be informed',
            'account.string' => 'The field account must be string',
            'type.required' => 'The field type must be informed',
            'type.numeric' => 'The field type must be numeric',
            'type.in' => 'The field type must be 1 or 2',
        ]
    ]
];
