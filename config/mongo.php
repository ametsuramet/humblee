<?php

return array(
    'db' => array(
        'development' => array(
            'host' => env('MONGO_HOST','localhost'),
            'port' => env('MONGO_PORT',27017),
            'database' => env('MONGO_DATABASE','test'),
            'user' => env('MONGO_USERNAME',null),
            'password' => env('MONGO_PASSWORD',null),
            ),
        ),
    );
