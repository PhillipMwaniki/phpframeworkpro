<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use PhillipMwaniki\Framework\Http\Kernel;
use PhillipMwaniki\Framework\Routing\Router;
use PhillipMwaniki\Framework\Routing\RouterInterface;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__).'/.env');

$container = new Container();

$container->delegate(new ReflectionContainer(true));

$appEnv = $_SERVER['APP_ENV'];

$container->add('APP_ENV', new StringArgument($appEnv));


// parameters for application config
$routes = include BASE_PATH . '/routes/web.php';

$container->add(RouterInterface::class, Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('setRoutes', [new ArrayArgument($routes)]);

$container->add(Kernel::class)
    ->addArgument(RouterInterface::class)
    ->addArgument($container);

return $container;