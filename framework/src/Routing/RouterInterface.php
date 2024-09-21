<?php

namespace PhillipMwaniki\Framework\Routing;

use PhillipMwaniki\Framework\Http\Request;
use Psr\Container\ContainerInterface;

interface RouterInterface
{
    public function dispatch(Request $request, ContainerInterface $container);

    public function setRoutes(array $routes): void;
}
