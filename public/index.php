<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

//php.ini edits
ini_set('memory_limit', '12G');
ini_set('post_max_size', '10G');
ini_set('upload_max_filesize', '5G');

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
