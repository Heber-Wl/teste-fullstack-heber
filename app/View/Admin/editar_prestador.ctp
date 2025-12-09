<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>

    <?php 
        echo $this->Html->css('reset');
        echo $this->Html->css('cadastroPrestador');
        echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css')
    ?>
</head>
<body>
    <main class="main">
        <div class="card-login">
            <div class="home">
                <h1 class="titulo">Cadastro de Prestador de Serviço</h1>
                <span class="sub-titulo">Informações pessoais</span>
                <span class="sub-sub-titulo">Cadastre suas informações e adicione uma foto. </span>
            </div>
            <?= $this->Form->create('Prestador', [
                'url' => ['controller' => 'admin', 'action' => 'atualizarPrestador'],
                'type' => 'file'
            ]) ?>
            <div class="form">
                <?php 
                    echo $this->Form->hidden('id', [
                        'value' => $prestador['Prestador']['id']
                    ]);
                ?>
                <div class="inpts">
                    <label class="label">
                        Nome completo
                    </label>
                    <?= $this->Form->input('nome', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'placeholder' => 'Digite seu nome',
                        'value' =>  $prestador['Prestador']['nome']
                    ]); ?>
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
                        'type' => 'email',
                        'value' =>  $prestador['Prestador']['email']
                    ]); ?>
                </div>
                <div class="inpts">
                    <label class="label">
                        Foto de perfil
                    </label>
                    <div class="foto">
                        <?php if (!empty($prestador['foto'])): ?>
                            <img src="/img/prestadores/<?= $prestador['foto'] ?>" 
                                alt="Foto" 
                                class="foto-atual">
                        <?php else: ?>
                            <!-- Ícone padrão -->
                            <svg class="icone user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="#909194ff" d="M12 2C6.477 2 2 6.477 ..."/>
                            </svg>
                        <?php endif; ?>

                        <!-- Input file -->
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
                        Telefone
                    </label>
                    <?= $this->Form->input('telefone', [
                        'label' => false,
                        'div' => false,
                        'class' => 'input',
                        'placeholder' => '(99) 99999-9999',
                        'oninput' => 'formatarTelefone(this)',
                        'value' =>  $prestador['Prestador']['telefone']
                    ]); ?>
                </div>
            </div>
            <div class="inpts servicos">
                <label class="label">
                    Serviços
                </label>
                <div class="lista-servicos">
                    <?php foreach ($servicos as $id => $descricao): ?>
                        <div class="lista-de-servicos">
                            <div class="junto">
                                <input type="checkbox"
                                    name="data[PrestadorServico][servico][<?= $id ?>][id]"
                                    value="<?= $id ?>"
                                    <?= in_array($id, $servicosMarcados) ? 'checked' : '' ?>>
                                <?= $descricao ?>
                            </div>

                            <input type="number" step="0.01" min="0"
                                placeholder="Valor"
                                name="data[PrestadorServico][servico][<?= $id ?>][valor]"
                                class="input-servico-valor"
                                value="<?= isset($valoresMarcados[$id]) ? $valoresMarcados[$id] : '' ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="botoes">
                <input id="submit-btn" class="botao-entrar" type="submit" value="Salvar">
                <span class="nao-login" >Já tem uma conta? <a class="link-nao-login" href="<?php echo $this->Html->url('/'); ?>">Faça login</a></span>
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