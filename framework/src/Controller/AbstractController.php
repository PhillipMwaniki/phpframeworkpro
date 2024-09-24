<?php

namespace PhillipMwaniki\Framework\Controller;

use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    protected ContainerInterface $container;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}
