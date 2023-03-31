<?php
// les constantes :
require_once(__DIR__ . '/../config/constants.php');

// le helper :
require_once(__DIR__ . '/../helper/dd.php');


class Database
{

    public static function getInstance()
    {

        $db = new PDO(DSN, USER, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $db;
    }

}


// class Database
// {
//     private static object $connection;

//     // pour la transaction :
//     public static function getInstance()
//     {
//         if (is_null(self::$connection)) {
//             self::$connection = new PDO(DSN, USER, PASSWORD);
//             self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//         }
//         return self::$connection;
//     }
// }