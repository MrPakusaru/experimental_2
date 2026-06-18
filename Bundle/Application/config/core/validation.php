<?php

return [
    'model' => [
        'core'                      => 'required|array',
        'core.table'                => 'required|string',
        'core.connection'           => 'nullable|string',
        'core.available_params'     => 'required|array',
        'core.available_params.*'   => 'string|in:timestamps',
        'fields'                    => 'required|array',
        'fields.*'                  => 'required|array',
        'fields.*.column'           => 'required|string',
        'fields.*.cast'             => 'required|string',
        'fields.*.requirements'     => 'required|array',
        'fields.*.requirements.*'   => 'string|in:nullable'
    ]
];
