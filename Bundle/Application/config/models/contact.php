<?php

return [
    'core' => [
        'table' => 'exp_contacts',
        'available_params' => ['timestamps']
    ],
    'fields' => [
        'surname'  => [
            'column' => 'SURNAME',
            'cast' => 'string',
            'requirements' => ['nullable'],
        ],
        'name'  => [
            'column' => 'NAME',
            'cast' => 'string',
            'requirements' => ['nullable'],
        ],
        'last_name'  => [
            'column' => 'LAST_NAME',
            'cast' => 'string',
            'requirements' => ['nullable'],
        ],
        'email' => [
            'column' => 'EMAIL',
            'cast' => 'string',
            'requirements' => ['nullable'],
        ],
        'phone' => [
            'column' => 'PHONE',
            'cast' => 'string',
            'requirements' => ['nullable'],
        ],
        'birth_date' => [
            'column' => 'BIRTH_DATE',
            'cast' => 'date',
            'requirements' => ['nullable'],
        ]
    ],
    'relations' => [
        'contacts' => [
            'type'   => 'many',
            'entity' => 'contact',
            'foreign_key' => 'user_id',
        ],
    ],
];
