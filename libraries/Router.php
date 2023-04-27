<?php
namespace Lib;

class Router {
    private $routes = array();

    public function addRoute($method, $pattern, $callback) {
        $this->routes[] = array(
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        );

        return $this;
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] != $method) {
                continue;
            }
            
            $regexPattern = preg_replace_callback(
                '/:\w+/',
                function ($params) {
                    return '([^/]+)';
                },
                $route['pattern']
            );

            if (preg_match("#^{$regexPattern}$#", $uri, $params)) {
                array_shift($params);
                return call_user_func_array($route['callback'], $params);
            }
        }
        header('HTTP/1.1 404 Not Found');
        die('404 Not Found');
    }
}
