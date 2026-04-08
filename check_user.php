<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = \App\Models\User::first();
if ($u) {
    echo 'name: ' . $u->name . PHP_EOL;
    echo 'email: ' . $u->email . PHP_EOL;
    echo 'is_admin: ' . ($u->is_admin ? 'true' : 'false') . PHP_EOL;
} else {
    echo 'NO USER FOUND' . PHP_EOL;
}
