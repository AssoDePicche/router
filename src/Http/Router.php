<?php

declare(strict_types=1);

namespace Http;

use BadMethodCallException;
use Closure;
use Exception;
use Http\Enum\Method;
use Http\Exception\InternalServerError;
use Http\Exception\MethodNotAllowedException;
use Http\Exception\NotFoundException;
use Http\Response;
use ReflectionFunction;

final class Router
{
    private array $routes = [];

    public function __call(string $methodName, array $methodParams): void
    {
        $allowedMethods = [Method::GET, Method::POST];

        $methodName = strtoupper($methodName);

        !in_array($methodName, $allowedMethods) && throw new BadMethodCallException('Invalid Method Name');

        [$route, $callback] = $methodParams;

        $routeParameters = ['controller' => [], 'variable' => []];

        if ($callback instanceof Closure) {
            $routeParameters['controller'] = $callback;
        }

        $variablePattern = '/{(.*?)}/';

        if (preg_match_all($variablePattern, $route, $matches)) {
            $route = preg_replace($variablePattern, '(.*?)', $route);

            $routeParameters['variable'] = end($matches);
        }

        $routePattern = '/^' . str_replace('/', '\/', $route) . '$/';

        $this->routes[$routePattern][$methodName] = $routeParameters;
    }

    private function getRoute(Request $request): array
    {
        $route = $request->getURI();

        $httpMethod = $request->getMethod();

        foreach ($this->routes as $routePattern => $method) {
            if (!preg_match($routePattern, $route, $matches)) {
                continue;
            }

            if (isset($method[$httpMethod])) {
                unset($matches[0]);

                $keys = $method[$httpMethod]['variable'];

                $method[$httpMethod]['variable'] = array_combine($keys, $matches);

                $method[$httpMethod]['variable']['request'] = $request;

                return $method[$httpMethod];
            }

            throw new MethodNotAllowedException;
        }

        throw new NotFoundException;
    }

    public function handle(Request $request): Response
    {
        try {
            $route = $this->getRoute($request);

            !($route['controller'] instanceof Closure) && throw new InternalServerError;

            $args = [];

            $reflection = new ReflectionFunction($route['controller']);

            foreach ($reflection->getParameters() as $parameter) {
                $parameterName = $parameter->getName();

                $args[$parameterName] = $route['variable'][$parameterName] ?? '';
            }

            return call_user_func_array($route['controller'], $args);
        } catch (Exception $exception) {
            return Response::createFromException($exception);
        }
    }
}
