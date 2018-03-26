<?php
namespace App\Lib;

//use PDO;

class DatabaseMSS
{
    public static function StartUp()
    {

        $DB_host = "192.168.1.230";
        $DB_user = "sa";
        $DB_pass = "B1Admin";
        $DB_name = "LAB_LAFAR";

        /*$DB_host = "192.168.1.213";
        $DB_user = "lafaradmDB";
        $DB_pass = "";
        $DB_name = "newlafarnet";*/
        $conn = mssql_connect("192.168.1.230", "sa", "B1Admin");
        if (!$conn)
        { 
          die('Not connected : ' . mssql_get_last_message());
        } 
        $db_selected = mssql_select_db($DB_name,$conn);
        if (!$db_selected) 
        {
          die ('Can\'t use db : ' . mssql_get_last_message());
        } 

        return $conn;
    }
}