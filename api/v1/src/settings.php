<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'redismaster' => [
            'scheme' => 'tcp',
            'host' => 'localhost',
            'port' => '6379',
            'password' => 'mypass'
        ],

        'redisslave' => [
            'scheme' => 'tcp',
            'host' => 'localhost',
            'port' => '6379',
            'password' => 'mypass'
        ],

        'elasticsearch' => [
            'host' => [
              '192.168.1.174:9200'
            ]
        ],

        // Database
        'db' => [
            'host' => 'localhost', // To change port, just add it afterwards like localhost:8889
            'dbname' => 'alkamilbooking', // DB name or SQLite path
            'username' => 'root',
            'password' => '',
            'port' => '3306'
        ],
    ],
];
