<?php

namespace App\Controllers;

use PhillipMwaniki\Framework\Controller\AbstractController;
use PhillipMwaniki\Framework\Http\Response;

class PostController extends AbstractController
{
    public function show(int $id): Response
    {

        return $this->render('post.twig', ['postId' => $id]);
    }

    public function create()
    {
        return $this->render('create-post.twig');
    }
}
