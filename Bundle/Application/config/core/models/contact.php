<?php

return [
    'core' => [
        'table' => 'exp_contacts',
        'connection' => '',
        'available_params' => ['timestamps']
    ],
    'fields' => [
        'user_link' => [
            'column' => 'USER_ID',
            'cast' => '',
            'requirements' => ['fillable'],
        ],
        'name'  => [
            'column' => 'NAME',
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'surname'  => [
            'column' => 'SURNAME',
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'middle_name'  => [
            'column' => 'MIDDLE_NAME',
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'email' => [
            'column' => 'EMAIL',
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'phone' => [
            'column' => 'PHONE',
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'birth_date' => [
            'column' => 'BIRTH_DATE',
            'cast' => '',
            'requirements' => ['fillable'],
        ]
    ],
     'relations' => [
         // 'contacts' => [
         //     'type'   => 'many',
         //     'entity' => 'contact',
         //     'foreign_key' => 'user_id',
         // ],
     ],
];
