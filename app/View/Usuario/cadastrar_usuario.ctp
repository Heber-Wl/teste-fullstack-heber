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
                <h1 class="titulo">Cadastrar Prestador</h1>
                <span class="sub-titulo">Preencha os dados para se cadastrar</span>
            </div>
            <?= $this->Form->create('Prestador', [
                'url' => ['controller' => 'usuario', 'action' => 'cadastroUsuario'],
                'type' => 'file'
            ]) ?>
            <div class="form">
                <div class="inpts">
                    <label class="label">
                        Nome completo
                    </label>
                    <?= $this->Form->input('nome', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'placeholder' => 'Digite seu nome'
                    ]); ?>
                </div>
                <div class="inpts">
                    <label class="label">
                        Foto de perfil
                    </label>
                    <div class="foto">
                        <svg class="icone user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#909194ff" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m0 18.5a8.5 8.5 0 1 1 .001-17.001A8.5 8.5 0 0 1 12 20.5m0-8c-3.038 0-5.5 1.728-5.5 3.5s2.462 3.5 5.5 3.5s5.5-1.728 5.5-3.5s-2.462-3.5-5.5-3.5m0-.5a3 3 0 1 0 0-6a3 3 0 0 0 0 6"/></svg>
                        <?= $this->Form->input('foto', [
                            'type' => 'file',
                            'label' => false,
                            'div' => false,
                            'class' => 'input file',
                            'id' => 'foto'
                        ]); ?>
                    </div>
                </div>
                <div class="inpts">
                    <label class="label">
                        E-mail
                    </label>
                    <?= $this->Form->input('email', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'placeholder' => 'seu@email.com',
                        'type' => 'email'
                    ]); ?>
                </div>
                <div class="inpts">
                    <label class="label">
                        Telefone
                    </label>
                    <?= $this->Form->input('telefone', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'placeholder' => '(99) 99999-9999',
                        'oninput' => 'formatarTelefone(this)'
                    ]); ?>
                </div>
                <div class="inpts">
                    <label class="label">
                        Senha
                    </label>
                    <?= $this->Form->input('password', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'type' => 'password',
                        'placeholder' => '********',
                        'id' => 'password'
                    ]); ?>
                    <small id="senha-min-error" style="color: red; display: none;">A senha deve ter pelo menos 8 caracteres.</small>
                </div>
                <div class="inpts">
                    <label class="label">
                        Confirmar senha
                    </label>
                    <?= $this->Form->input('confirm_password', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'type' => 'password',
                        'placeholder' => '********',
                        'id' => 'password_confirmation'
                    ]); ?>
                    <small id="senha-match-error" style="color: red; display: none;">As senhas não coincidem.</small>
                </div>
                <div class="inpts">
                    <label class="label">
                        Serviços
                    </label>
                    <div class="lista-servicos">
                        <?php foreach ($servicos as $id => $descricao): ?>
                            <div class="lista-de-servicos">
                                <input type="checkbox"
                                        name="data[PrestadorServico][servico][<?= $id ?>][id]"
                                        value="<?= $id ?>">
                                    <?= $descricao ?>
                                <input type="number" step="0.01" min="0"
                                    placeholder="Valor"
                                    name="data[PrestadorServico][servico][<?= $id ?>][valor]"
                                    class="input-servico-valor">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="botoes">
                    <input id="submit-btn" class="botao-entrar" type="submit" value="Salvar">
                    <span class="nao-login" >Já tem uma conta? <a class="link-nao-login" href="<?php echo $this->Html->url('/'); ?>">Faça login</a></span>
                </div>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </main>
    <?php 
        echo $this->Html->script('formatarTelefone');
        echo $this->Html->script('verificadorSenha');
    ?>
</body>
</html>