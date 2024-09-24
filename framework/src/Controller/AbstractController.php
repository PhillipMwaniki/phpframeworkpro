<?php

namespace PhillipMwaniki\Framework\Controller;

use PhillipMwaniki\Framework\Http\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    protected ContainerInterface $container;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function render(string $template, array $data = [], Response $response = null): Response
    {
        $content = $this->container->get('twig')->render($template, $data);

        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }

}
