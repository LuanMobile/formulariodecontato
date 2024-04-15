<?php

namespace App\Models;

class Form extends Database
{
    public static function save(array $data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            INSERT INTO db_test (name, email, subject, message)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['subject'],
            $data['message']
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }
}
