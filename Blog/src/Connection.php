<?php

namespace App;

use \PDO;

class Connection{

    public static function getPdo(): PDO
    {
        return $pdo = new PDO('mysql:dbname=blog-grafikart;host:127.0.0.1', 'phpG', 'grafikart', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

}