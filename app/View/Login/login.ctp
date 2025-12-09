<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php 
        echo $this->Html->css('reset');
        echo $this->Html->css('login');
        echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css')
    ?>
</head>
<body>
    <main class="main">
        <div class="card-login">
            <div class="home">
                <h1 class="titulo">Bem-vindo</h1>
                <span class="sub-titulo">Faça login para acessar sua conta</span>
            </div>
            <?= $this->Form->create('Admin', [
                'url' => ['controller' => 'login', 'action' => 'loginAdmin']
            ]) ?>
            <div class="form">
                <div class="inpts">
                    <label class="label">E-mail</label>
                    <?= $this->Form->input('email', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'type'  => 'email',
                        'placeholder' => 'seu@email.com'
                    ]); ?>
                </div>

                <div class="inpts">
                    <label class="label">Senha</label>
                    <?= $this->Form->input('senha', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'type'  => 'password',
                        'placeholder' => '********'
                    ]); ?>
                </div>
                <div class="botoes">
                    <input class="botao-entrar" type="submit" value="Entrar">
                    <span class="nao-login" >Não tem conta? <a class="link-nao-login" href="<?php echo $this->Html->url('/cadastrar-admin'); ?>">Cadastre-se</a></span>
                </div>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </main>
</body>
</html>