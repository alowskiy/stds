<?php

namespace Actions;

use Controllers\Support\TokenService;
use Repositories\UserRepository;
use Vendor\DBConnection;

class AuthUserAction
{
    public function execute($cred)
    {
        $user = new UserRepository();
        $token = new TokenService();
        $readyToken = $token->createToken();
        $user->auth(
            $cred["email"],
            $cred["password"],
            $readyToken["token"],
            $readyToken["exp"]
        );

        return $readyToken;
    }
}
