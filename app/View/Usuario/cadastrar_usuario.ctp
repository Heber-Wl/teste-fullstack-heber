<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

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
                <h1 class="titulo">Criar Conta</h1>
                <span class="sub-titulo">Preencha os dados para se cadastrar</span>
            </div>
            <div class="form">
                <div class="inpts">
                    <label class="label">
                        Nome completo
                    </label>
                    <input class="input" type="text" name="nome" id="" placeholder="Digite seu nome">
                </div>
                <div class="inpts">
                    <label class="label">
                        E-mail
                    </label>
                    <input class="input" type="email" name="email" id="" placeholder="seu@email.com">
                </div>
                <div class="inpts">
                    <label class="label">
                        Telefone
                    </label>
                    <input class="input" type="text" name="telefone" id="" placeholder="(99) 99999-9999">
                </div>
                <div class="inpts">
                    <label class="label">
                        Senha
                    </label>
                    <input class="input" type="password" name="senha" id="" placeholder="********">
                </div>
                <div class="inpts">
                    <label class="label">
                        Confirmar senha
                    </label>
                    <input class="input" type="password" name="senha" id="" placeholder="********">
                </div>
                <div class="botoes">
                    <input class="botao-entrar" type="submit" value="Entrar">
                    <span class="nao-login" >Já tem uma conta? <a class="link-nao-login" href="<?php echo $this->Html->url('/'); ?>">Faça login</a></span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>