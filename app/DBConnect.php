<?php

namespace App;
use PDO;

class DBConnect
{

    public function pdo(): PDO
    {
        static $pdo;

        if (!$pdo) {
            $dsn = 'mysql:dbname=test_web;host=localhost';
            $pdo = new PDO($dsn, 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $pdo;
    }
}