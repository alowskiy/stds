<?php

namespace Router;

use Controllers\Support\TokenService;
use Controllers\Users\AuthController;
use Controllers\Users\UserController;

class Router
{
    public $route;
    public function __construct($route)
    {
        $this->route = $route;
    }

    public function checkRoute($route)
    {
      
      require_once('routes.php');

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
