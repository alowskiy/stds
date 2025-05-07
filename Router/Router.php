<?php

namespace Router;

use Controllers\Support\TokenService;
use Controllers\Users\AuthController;
use Controllers\Users\UserController;
use Views\Lists;
use Views\Lists2;

class Router
{
    public $route;
    public function __construct($route)
    {
        $this->route = $route;
    }

    public function checkRoute($route)
    {
        //Passing uri, className, methodName
        $routes = [
            "/" => [
                "class" => UserController::class,
                "method" => "getAll",
            ],
            "/me" => [
                "class" => UserController::class,
                "method" => "getByAuth",
            ],
            "/reg" => [
                "class" => AuthController::class,
                "method" => "regUser",
            ],
            "/auth" => [
                "class" => AuthController::class,
                "method" => "authUser",
            ],

            "/tok" => [
                "class" => TokenService::class,
                "method" => "authorize",
            ],
            "/edit" => [
                "class" => UserController::class,
                "method" => "edit",
            ],
        ];

        $key = array_key_exists($route, $routes);

        if ($key === false) {
            echo "NotFound!!";
        } else {
            $class = $routes[$route]["class"];
            $method = $routes[$route]["method"];
            $inst = new $class();
            $inst->$method();
        }
    }
}
