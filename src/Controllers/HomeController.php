<?php

namespace App\Controllers;

use App\Widget;
use PhillipMwaniki\Framework\Http\Response;

class HomeController
{
    public function __construct(private Widget $widget)
    {
    }

    public function index()
    {

        $content = "<h1>Hello from the home, {$this->widget->name}</h1>";

        return new Response($content);

    }
}
