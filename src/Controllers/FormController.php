<?php

namespace App\Controllers;

use Exception;
use App\Utils\Email;
use League\Plates\Engine;
use App\Services\FormService;

class FormController
{
    public function index()
    {
        $this->view('form', ['title' => 'Formulário']);
    }

    public static function store()
    {
        $form = FormService::create($_POST);

        if (isset($form['error'])) return $form['error'];

        $email = new Email;
        $sent = $email->from($_POST['email'], $_POST['name'])
            ->to('email@example.com')
            ->subject($_POST['subject'])
            ->message($_POST['message'])
            ->send();

        if ($sent) {
            return header('Location: /');
        }

        echo ('Ocorreu um erro ao enviar o email');
    }

    protected function view(string $view, array $data = [])
    {
        $viewPath = "../src/views/" . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("A view {$view} não existe");
        }

        $templates = new Engine('../src/views');
        echo $templates->render($view, $data);
    }
}
