<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
    'port' => env('MAIL_PORT', 465),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'from' => ["address" => env("MAIL_FROM_ADDRESS","support@humblee.com"), "name" => env("MAIL_FROM_NAME","Humblee Framework")],
    'sendmail' => '/usr/sbin/sendmail -bs',
];