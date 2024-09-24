<?php

namespace App\Controllers;

use App\Widget;
use PhillipMwaniki\Framework\Controller\AbstractController;
use PhillipMwaniki\Framework\Http\Response;

class HomeController extends AbstractController
{
    public function __construct(private Widget $widget)
    {
    }

    public function index()
    {
        dd($this->container->get('twig'));
        $content = "<h1>Hello from the home, {$this->widget->name}</h1>";

        return new Response($content);

    }
}
