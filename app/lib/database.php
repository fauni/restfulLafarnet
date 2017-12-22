<?php
namespace App\Lib;

use PDO;

class Database
{
    public static function StartUp()
    {

        $DB_host = "localhost";
        $DB_user = "root";
        $DB_pass = "";
        $DB_name = "newlafarnet";

        $pdo = new PDO('mysql:host='.$DB_host.';dbname='.$DB_name.';charset=utf8', $DB_user, $DB_pass);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
        return $pdo;
    }
}