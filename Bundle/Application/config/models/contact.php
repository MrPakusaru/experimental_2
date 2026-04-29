<?php

return [
    'core' => [
        'table' => 'exp_contacts'
    ],
    'fields' => [
        'surname'  => [
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'name'  => [
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'last_name'  => [
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'email' => [
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'phone' => [
            'cast' => 'string',
            'requirements' => ['nullable', 'fillable'],
        ],
        'birth_date' => [
            'cast' => 'date',
            'requirements' => ['nullable', 'fillable'],
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
