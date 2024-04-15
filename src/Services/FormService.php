<?php

namespace App\Services;

use App\Models\Form;
use App\Utils\Validator;

class FormService
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name'    => $data['name']      ??  '',
                'email'   => $data['email']     ??  '',
                'subject' => $data['subject']   ??  '',
                'message' => $data['message']   ??  '',
            ]);

            $form = Form::save($fields);

            if (!$form) return ['error' => "Mensagem não foi enviada."];

            return "Mensagem enviada com sucesso.";
        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];

            return ['error' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
