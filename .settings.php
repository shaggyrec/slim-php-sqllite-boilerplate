<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'url' => 'sqlite:////' . __DIR__ . '/db/db.sqlite'
        ],
        'dbTest' => [
            'url' => 'sqlite:////' . __DIR__ . '/db/db-test.sqlite'
        ]
    ]
];
