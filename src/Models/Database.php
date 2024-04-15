<?php

namespace App\Models;

use PDO;

class Database
{
    public static function getConnection()
    {
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres", "postgres", "psswd", [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return $pdo;
    }
}
