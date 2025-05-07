<?php

namespace Actions;

use Controllers\Support\ValidatorService;
use Repositories\UserRepository;

class EditUserAction
{
    public function execute($token, $cred)
    {
        $userRepo = new UserRepository();
        $edit = $userRepo->edit($token, $cred);
        return $edit;
    }
}
