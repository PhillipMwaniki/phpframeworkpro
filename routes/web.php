<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use PhillipMwaniki\Framework\Http\Response;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [PostController::class, 'show']],
    ['GET', '/posts/', [PostController::class, 'create']],
    ['GET', '/hello/{name:.+}', function (string $name) {
        return new Response("Hello $name");
    }],
];
