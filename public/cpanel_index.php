<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// IMPORTANT: Change "portfolio_core" to the name of the folder where you uploaded your backend files.
// For example, if you uploaded the backend to /home/username/my_laravel_app, change this to "my_laravel_app".
$core_folder = 'portfolio_core';

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

if (file_exists(__DIR__.'/../'.$core_folder.'/vendor/autoload.php')) {
    require __DIR__.'/../'.$core_folder.'/vendor/autoload.php';
} else {
    die("Composer autoload not found. Make sure you correctly uploaded the backend to /{$core_folder}");
}

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../'.$core_folder.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
