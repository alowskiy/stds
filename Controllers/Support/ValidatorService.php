<?php

namespace Controllers\Support;

class ValidatorService
{
    public $password;
    public $email;
    public $name;
    public $groupNum;

    public function validName()
    {
        if ($this->name >= 2) {
            return $this->name;
        } else {
            return false;
        }
    }

    public function validEmail()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return $this->email;
        } else {
            return false;
        }
    }

    public function validPassword()
    {
        if ($this->password >= 2) {
            return $this->password;
        } else {
            return false;
        }
    }

    public function validGroupNum()
    {
        if ($this->groupNum >= 2) {
            return $this->password;
        } else {
            return false;
        }
    }

    public function validRegForm()
    {
        $keys = true;
        $whitelist = ["password", "email", "name", "groupNum"];

        for ($i = 0; $i < count($whitelist); $i++) {
            if (!array_key_exists($whitelist[$i], $_POST)) {
                $keys = false;

                break;
            }
        }
        if ($keys == true) {
            $reg = $_POST;
            return $reg;
        } else {
            echo null;
        }
    }

    public function validAuthForm()
    {
        $keys = true;
        $whitelist = ["password", "email"];

        for ($i = 0; $i < count($whitelist); $i++) {
            if (!array_key_exists($whitelist[$i], $_POST)) {
                $keys = false;

                break;
            }
        }
        if ($keys == true) {
            $auth = $_POST;
            return $auth;
        } else {
            echo null;
        }
    }

    public function validEditForm()
    {
        $keys = true;
        $whitelist = ["password", "email", "name", "groupNum"];

        for ($i = 0; $i < count($whitelist); $i++) {
            if (!array_key_exists($whitelist[$i], $_POST)) {
                $keys = false;

                break;
            }
        }
        if ($keys == true) {
            $edit = $_POST;
            return $edit;
        } else {
            echo null;
        }
    }
}
