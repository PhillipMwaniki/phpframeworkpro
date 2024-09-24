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
        return $this->render('welcome.twig', [
          'name' => $this->widget->name,
        ]);

    }
}
