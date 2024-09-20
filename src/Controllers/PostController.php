<?php

namespace App\Controllers;

use PhillipMwaniki\Framework\Http\Response;

class PostController
{
    public function show(int $id)
    {
        $content = "Post ID is $id";

        return new Response($content);
    }
}
