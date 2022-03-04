<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once './conexao.php';
require './lib/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Formulário de contato para enviar e-mail e salvar no bd</title>
</head>
<body>
    
    <h2>Enviar Mensagem</h2>

    <?php

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($data['SendAddMsg'])) {
        //var_dump($data);
        $query_msg = "INSERT INTO usuarios (name, email, subject, content, created) VALUES(:name, :email, :subject, :content, NOW())";
         $add_msg = $conn->prepare($query_msg);

        $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $add_msg->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
        $add_msg->bindParam(':content', $data['content'], PDO::PARAM_STR);

        $add_msg->execute();

        if($add_msg->rowCount()) {
            $mail = new PHPMailer(true);

            try {
                   $mail->SMTPDebug = false;
                   $mail->CharSet = 'UTF-8';
                   $mail->isSMTP();
                   $mail->Host = 'smtp.mailtrap.io';
                   $mail->SMTPAuth = true;
                   $mail->Username = '4322ec4bca9c9a';
                   $mail->Password = '5eff625a507f82';
                   $mail->SMTPSecure = PHPMailer:: ENCRYPTION_STARTTLS;
                   $mail->Port = 2525;
 
                   //Enviar e-mail para o cliente
                   $mail->setFrom('atendimento@santos.com.br', 'Atendimento');
                   $mail->addAddress($data['email'], $data['name']);
 
                   $mail->isHTML(true);
                   $mail->Subject = 'Recebi a mensagem de contato';
                   $mail->Body = "Prezado(a) " . $data['name'] . "<br><br>Recebi o seu e-mail.<br>Será lido o mais rápido possível.<br>Em breve será respondido.<br><br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                   $mail->AltBody = "Prezado(a) " . $data['name'] . "\n\nRecebi o seu e-mail.\nSerá lido o mais rápido possível.\nEm breve será respondido.\n\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];
 
                   $mail->send();
                   
                   $mail->clearAddresses();
 
                   //Enviar e-mail para o colaborador da empresa
                   $mail->setFrom('atendimento@santos.com.br', 'Atendimento');
                   $mail->addAddress('Maria@santos.com.br', 'Maria');
 
                   $mail->isHTML(true);
                   $mail->Subject = $data['subject'];
                   $mail->Body = "Nome: " . $data['name'] . "<br>E-mail: " . $data['email'] . "<br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                   $mail->AltBody = "Nome: " . $data['name'] . "\nE-mail: " . $data['email'] . "\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];
 
                   $mail->send();
                    unset($data);
                     echo "<p class='alert alert-success' role='alert'> Mensagem de contato enviada com sucesso!<br></p>";                    
                 } catch (Exception $e) {
                     echo "<p class='alert alert-danger' role='alert'> Erro: Mensagem de contato não enviada com sucesso!<br></p>";
                 }
             } else {
                 echo "<p class='alert alert-danger' role='alert'> Erro: Mensagem de contato não enviada com sucesso!<br></p>";
             }
           
    }

    ?>

    <form name="add-msg" action="" method="POST">
            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Nome completo" value="<?php
            if (isset($data['name'])) {
                echo $data['name'];
            }
            ?>" autofocus required><br><br>

            <label>E-mail: </label>
            <input type="email" name="email" id="email" placeholder="O melhor e-mail"  value="<?php
            if (isset($data['email'])) {
                echo $data['email'];
            }
            ?>" required><br><br>

            <label>Assunto: </label>
            <input type="text" name="subject" id="subject" placeholder="Assunto da mensagem"  value="<?php
            if (isset($data['subject'])) {
                echo $data['subject'];
            }
            ?>" required><br><br>

            <label>Conteúdo: </label>
            <input type="text" name="content" id="content" placeholder="Conteúdo da mensagem"  value="<?php
                   if (isset($data['content'])) {
                       echo $data['content'];
                   }
                   ?>" required><br><br>

            <input class="btn btn-primary" type="submit" value="Enviar" name="SendAddMsg">
        </form>


</body>
</html>