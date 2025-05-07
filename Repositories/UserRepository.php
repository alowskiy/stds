<?php

namespace Repositories;

use Repositories\Interfaces\UserRepositoryInterface;
use Vendor\DBConnection;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    public function all($offset, $srt)
    {
        $db = new DBConnection();
        $dbh = $db->connect();
        $sql = "SELECT * FROM students LIMIT ? OFFSET ?";

        $res = $dbh->query("SELECT COUNT(*) FROM students");
        $countNum = $res->fetchColumn();

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $srt, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $res = $stmt->execute();
        $res2 = $stmt->fetchAll();

        return [$countNum, $res2];
    }
    public function getByToken($token)
    {
        $db = new DBConnection();
        $dbh = $db->connect();
        $readyToken = str_replace("Bearer ", "", $token);
        $sql = "SELECT * FROM students WHERE accessToken = ?";
        $stmt = $dbh->prepare($sql);
        $res = $stmt->execute([$readyToken]);
        $res2 = $stmt->fetch();

        return $res2;
    }

    public function registr($email, $password, $name, $groupNum, $token, $exp)
    {
        $db = new DBConnection();
        $dbh = $db->connect();

        $sql =
            "INSERT INTO students (email, password, name, groupNum, accessToken, exp_date) VALUES (?, ?, ?, ?,?,?)";
        $stmt = $dbh->prepare($sql);
        $res = $stmt->execute([
            $email,
            $password,
            $name,
            $groupNum,
            $token,
            $exp,
        ]);

        if ($res) {
            return $res;
        }
    }
    public function auth($email, $password, $token, $exp)
    {
        $db = new DBConnection();
        $dbh = $db->connect();
        $sql = "SELECT * FROM students WHERE email =? AND password = ?";
        $stmt = $dbh->prepare($sql);
        $res = $stmt->execute([$email, $password]);
        $res2 = $stmt->fetch();

        if ($res2) {
            $sql =
                "UPDATE students SET accessToken = ?, exp_date = ? WHERE email =?";
            $stmt = $dbh->prepare($sql);
            $res = $stmt->execute([ $token, $exp, $res2["email"]]);

            return $res2;
        }
    }

    public function edit($token, $cred)
    {
        if ($cred) {
            $db = new DBConnection();
            $dbh = $db->connect();
            $sql =
                "UPDATE students SET email =?, password = ?, groupNum = ?, name = ?  WHERE accessToken = ?";
            $stmt = $dbh->prepare($sql);
            $res = $stmt->execute([
                $token["token"],
                $cred["email"],
                $cred["password"],
                $cred["groupNum"],
                $cred["name"],
            ]);
            if ($res) {
                return $cred;
            }
        }
    }
}
