<?php

return [
    'database' => [
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ticket-tailor',
        'username' => 'homestead',
        'password' => 'secret',
        'options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    ],
];