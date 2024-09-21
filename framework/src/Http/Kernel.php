<?php

namespace PhillipMwaniki\Framework\Http;

use PhillipMwaniki\Framework\Routing\Router;
use PhillipMwaniki\Framework\Routing\RouterInterface;
use Psr\Container\ContainerInterface;

class Kernel
{
    public function __construct(
        private RouterInterface $router,
        private ContainerInterface $container
    ) {
    }
    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);

            $response = call_user_func_array($routeHandler, $vars);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponse($e);
        }

        return $response;
    }

    /**
     * @param \Exception $exception
     * @return Response
     */
    private function createExceptionResponse(\Exception $exception): Response
    {
        if ($exception instanceof HttpException) {
            return new Response($exception->getMessage(), $exception->getStatusCode());
        }

        return new Response('Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
