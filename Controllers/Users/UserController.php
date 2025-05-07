<?php

namespace Controllers\Users;

use Actions\EditUserAction;
use Controllers\Support\PaginatorService;
use Controllers\Support\TokenService;
use Controllers\Support\ValidatorService;

class UserController
{
    public function getByAuth()
    {
        $token = new TokenService();
        $tok = $token->authorize();
        return $tok;
    }
    public function getAll()
    {
        $pag = new PaginatorService();
        $paginate = $pag->getPag();
        echo json_encode($paginate);
    }

    public function edit()
    {
        $validator = new ValidatorService();
        $cred = $validator->validEditForm();
        $token = $this->getByAuth();
        $editUser = new EditUserAction();
        $user = $editUser->execute($token, $cred);
        $success = "successfully edited!";
        $error = "Error!";
        if ($user) {
            echo $success;
        } else {
            echo $error;
        }
    }
}
