<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Vercel serverless environment paths (filesystem is ephemeral/read-only except /tmp)
$_SERVER['APP_BASE_PATH'] = dirname(__DIR__);

// Ensure directories exist in /tmp for storage, cache, sessions, and views
$tmpStorage = '/tmp/storage';
$tmpDirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpStorage . '/app/public',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Redirect compiled view path to writable /tmp
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
$_ENV['VIEW_COMPILED_PATH'] = "{$tmpStorage}/framework/views";

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Bind custom storage path to /tmp
$app->useStoragePath($tmpStorage);

$app->handleRequest(Request::capture());
