<?php

namespace App\support;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    private string $to;
    private string $from;
    private string $fromName;
    private string $subject;
    private string $message;
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = env('EMAIL_HOST');
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = env('EMAIL_USERNAME');
        $this->mail->Password   = env('EMAIL_PASSWORD');
        $this->mail->Port       = env('EMAIL_PORT');
    }

    public function from(string $from, $fromName = ''): Email
    {
        $this->from = $from;
        $this->fromName = $fromName;
        return $this;
    }

    public function to($to): Email
    {
        $this->to = $to;
        return $this;
    }

    public function subject(string $subject): Email
    {
        $this->subject = $subject;
        return $this;
    }

    public function message(string $message): Email
    {
        $this->message = $message;
        return $this;
    }

    public function send()
    {
        $this->mail->setFrom($this->from, $this->fromName);
        $this->mail->addAddress($this->to);

        $this->mail->isHTML(true);
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->subject;
        $this->mail->AltBody = $this->message;

        return $this->mail->send();
    }
}
