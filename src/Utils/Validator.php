<?php

namespace App\Utils;

class Validator
{
    public static function validate(array $fields)
    {
        foreach ($fields as $field => $value) {
            if (empty($value)) {
                throw new \Exception("O campo ({$field}) está vázio");
            }
        }
        return $fields;
    }
}
