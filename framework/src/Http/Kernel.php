<?php

namespace PhillipMwaniki\Framework\Http;

use PhillipMwaniki\Framework\Routing\Router;
use PhillipMwaniki\Framework\Routing\RouterInterface;

class Kernel
{
    public function __construct(
        private RouterInterface $router
    ) {
    }
    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);

            $response = call_user_func_array($routeHandler, $vars);
        } catch (HttpException|HttpRequestMethodException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            $response = new Response($e->getMessage(), 500);
        }

        return $response;
    }
}
