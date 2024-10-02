<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use PhillipMwaniki\Framework\Controller\AbstractController;
use PhillipMwaniki\Framework\Dbal\ConnectionFactory;
use PhillipMwaniki\Framework\Http\Kernel;
use PhillipMwaniki\Framework\Routing\Router;
use PhillipMwaniki\Framework\Routing\RouterInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH .'/.env');

$container = new Container();

$container->delegate(new ReflectionContainer(true));

$appEnv = $_SERVER['APP_ENV'];

$templatePath = BASE_PATH . '/templates';

$container->add('APP_ENV', new StringArgument($appEnv));


// Console Kernel
$container->add(
    'base-commands-namespace',
    new StringArgument('PhillipMwaniki\\Framework\\Console\\Command\\')
);

$container->add(\PhillipMwaniki\Framework\Console\Kernel::class)
    ->addArgument($container);

// Database Setup
$databaseUrl = 'sqlite:///' . BASE_PATH . '/storage/db.sqlite';

$container->add(ConnectionFactory::class)
    ->addArgument(new StringArgument($databaseUrl));

$container->addShared(\Doctrine\DBAL\Connection::class, function () use ($container): \Doctrine\DBAL\Connection {
    return $container->get(ConnectionFactory::class)->create();
});


// Routing
$routes = include BASE_PATH . '/routes/web.php';

$container->add(RouterInterface::class, Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('setRoutes', [new ArrayArgument($routes)]);

$container->add(Kernel::class)
    ->addArgument(RouterInterface::class)
    ->addArgument($container);

// Twig Template Registration
$container->addShared('filesystem-loader', FilesystemLoader::class)
    ->addArgument(new StringArgument($templatePath));

$container->addShared('twig', \Twig\Environment::class)
    ->addArgument('filesystem-loader');

$container->add(AbstractController::class);

$container->inflector(AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

return $container;
