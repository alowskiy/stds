<?php

namespace Controllers\Support;

use Models\Token;
use Repositories\UserRepository;
use Vendor\DBConnection;

class TokenService
{
    public function createToken()
    {
        $token = "";
        $lang = "qwerfghjkvbnmzx1739QWERFGJCNZJOP024";
        $expDate = time() + 86400;
        $length = strlen($lang);

        for ($i = 0; $i < 11; $i++) {
            $token .= $lang[random_int(0, $length - 1)];
        }

        return ["token" => $token, "exp" => $expDate];
    }

    public function authorize()
    {
        $auth = $_SERVER["HTTP_AUTHORIZATION"];

        $val1 = $this->valid($auth);

        return $val1;
    }

    public function valid($token)
    {
        $val = null;
        $userRepo = new UserRepository();
        $user = $userRepo->getByToken($token);

        if ($user) {
            if ((int) $user["exp_date"] > time()) {
                return [
                    $val => true,
                    "exp" => $user["exp_date"],
                    "token" => $user["accessToken"],
                ];
            } else {
                echo 401;
                return http_response_code(401);
            }
        } else {
            echo "Auth Error!!";
            return http_response_code(401);
        }
    }
}
