<?php $this->layout('master', ['title' => $title]) ?>

<h1>Formulário</h1>

<div class="container p-5">
    <form action="/send_form" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" placeholder="Digite seu nome completo">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Digite um email válido">
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Assunto</label>
            <input type="text" name="subject" class="form-control" placeholder="Digite o assunto da mensagem">
        </div>
        <div class="mb-3">
            <label for="message">Mensagem</label>
            <textarea name="message" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>