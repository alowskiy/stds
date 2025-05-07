<?php

namespace Repositories\Interfaces;

use Models\User;
interface UserRepositoryInterface
{
    public function all($offset, $srt);
    public function getByToken($token);

    public function registr($email, $password,$name, $groupNum, $token,$exp);
    public function auth($email, $password, $token,$exp);
    
    public function edit($token,$cred);
}