<?php

namespace Actions;

use Models\User;
use Controllers\Support\TokenService;
use Repositories\UserRepository;
class RegistrUserAction
{
    public function execute($cred)
    {
        $token = new TokenService();
        $readyToken = $token->createToken();
        $user = new UserRepository();
        $user->registr(
            $cred["email"],
            $cred["password"],
            $cred["name"],
            $cred["groupNum"],
            $readyToken["token"],
            $readyToken["exp"]
        );
        return $readyToken;
    }
}
