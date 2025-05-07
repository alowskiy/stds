<?php

namespace Controllers\Users;

use Actions\AuthUserAction;
use Actions\RegistrUserAction;
use Actions\ValidTokenAction;
use Controllers\Support\AuthValidator;
use Controllers\Support\RegistrValidator;
use Controllers\Support\TokenService;
use Controllers\Support\ValidatorService;
use Models\User;
use Repositories\TokenRepository;
use Vendor\DBConnection;

class AuthController
{
    public $pwd;
    public $email;
    public $name;
    public $groupNum;

    public function regUser()
    {
        $valSer = new ValidatorService();
        $regData = $valSer->validRegForm();
        if ($regData) {
            $registrUserAction = new RegistrUserAction();
            $reg = $registrUserAction->execute($regData);

            if ($registrUserAction) {
                header("Content-Type: application/json");
                $json = json_encode([
                    "name" => $regData["name"],
                    "email" => $regData["email"],
                    "group" => $regData["groupNum"],
                    "token" => $reg,
                ]);
                echo $json;
            }
        }
    }

    public function authUser()
    {
        $valSer = new ValidatorService();
        $authData = $valSer->validAuthForm();

        if ($authData !== null) {
            $authAction = new AuthUserAction();
            $token = $authAction->execute($authData);

            if ($authAction) {
                header("Content-Type: application/json");
                $json = json_encode([
                    "name" => $authData["name"],
                    "email" => $authData["email"],
                    "token" => $token,
                ]);
                echo $json;
            }
        }
    }
}
