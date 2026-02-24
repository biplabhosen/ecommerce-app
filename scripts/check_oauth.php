<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$db = $app->make('db');

$id = '019c8faa-5eb6-7238-99f4-ed2e8eb2d95c';
$client = $db->table('oauth_clients')->where('id', $id)->first();

echo json_encode($client, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
