<?php

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails'               => true,

        'key' => 'aa809da5903cb9b1ec5a34a8967f3a38',

        'doctrine' => [
            'connection' => [
                'driver'    => "pdo_mysql",
                'host'      => '127.0.0.1',
                'dbname'    => 'sng_development', # Your Database
                'user'      => 'root', #user
                'password'  => 'root', #password
                'charset'   => 'utf8mb4'
            ],
            'annotation_paths'  => [__DIR__.'/App/Model/Entity'],
            'dev_mode'          => true
        ],
    ]
];
