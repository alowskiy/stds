<?php

use Controllers\Support\TokenService;
use Controllers\Users\AuthController;
use Controllers\Users\UserController;

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
