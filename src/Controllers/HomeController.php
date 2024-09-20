<?php

namespace App\Controllers;

use PhillipMwaniki\Framework\Http\Response;

class HomeController
{
    public function index()
    {

        $content = "<h1>Hello from the home controller</h1>";

        return new Response($content);

    }
}
