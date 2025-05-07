<?php
namespace Vendor;

use PDO;


class DBConnection
{
    public $db = 'stds';


    public function connect(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname='.$this->db, 'root','');
            return $pdo;
        } catch(PDOException $e){
            return [];
        }
    }
}

