<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting', E_ALL);


use PhillipMwaniki\Framework\Http\Kernel;
use PhillipMwaniki\Framework\Http\Request;
use PhillipMwaniki\Framework\Http\Response;
use PhillipMwaniki\Framework\Routing\Router;

// declare (strict_types=1);
define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$container = require BASE_PATH . '/config/services.php';

$request = Request::createFromGlobals();

$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);

$response->send();
