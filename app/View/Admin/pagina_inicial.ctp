<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>

    <?php 
        // CSS
        echo $this->Html->css('reset');
        echo $this->Html->css('paginaInicial');

        // Fonte
        echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

        // Bootstrap
        echo $this->Html->css('https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css');
        echo $this->Html->css('https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css');
        echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    ?>
</head>
<body>
    <main class="main-pagina-inicial">
        <div class="conteudo">
            <div class="home">
                <div class="titulos">
                    <h1 class="h1">Prestadores de Serviço</h1>
                    <span class="subtitulo">Veja sua lista de prestadores de serviço</span>
                </div>
                <div class="btn-opcoes" onclick="document.getElementById('importarArquivo').click()">
                    <button class="importar" data-bs-toggle="modal" data-bs-target="#modalImportar">
                        <svg class="icon importar-icone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M21 14a1 1 0 0 0-1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4a1 1 0 0 0-2 0v4a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-4a1 1 0 0 0-1-1m-9.71 1.71a1 1 0 0 0 .33.21a.94.94 0 0 0 .76 0a1 1 0 0 0 .33-.21l4-4a1 1 0 0 0-1.42-1.42L13 12.59V3a1 1 0 0 0-2 0v9.59l-2.29-2.3a1 1 0 1 0-1.42 1.42Z"/></svg>
                        Importar
                    </button>
                    <div class="modal fade" id="modalImportar" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Importar Prestadores</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="modelo">
                                    <span>Antes de importar, baixe o modelo da tabela:</span>
                                    <a href="/files/template_prestadores.csv" 
                                    class="link-baixar"
                                    >
                                        <svg class="icone-download" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#374151" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
                                        Baixar modelo
                                    </a>
                                </div>

                                <hr>
                                <?php
                                echo $this->Form->create('Import', [
                                    'url' => ['controller' => 'admin', 'action' => 'importar'],
                                    'type' => 'file'
                                ]);
                                ?>

                                <div class="mb-3">
                                    <?=
                                        $this->Form->input('arquivo', [
                                            'type' => 'file',
                                            'label' => 'Selecione o arquivo (CSV)',
                                            'required' => true
                                        ]);
                                    ?>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary botao" type="submit">Importar</button>
                            </div>

                            <?= $this->Form->end(); ?>

                            </div>
                        </div>
                    </div>

                    <a href="<?php echo $this->Html->url('/cadastrar'); ?>" class="adicionar">
                        <svg class="icon add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"/></svg>
                        Add novo prestador
                    </a>
                </div>
            </div>
            <table id="tabela-prestadores" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Prestador</th>
                        <th>Telefone</th>
                        <th>Serviços</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestadores as $prestador): ?>
                        <tr>
                            <td>
                                <div class="td">
                                    <?php if (!empty($prestador['Prestador']['foto'])): ?>
                                        <img class="foto-prestador"
                                            src="<?= $this->Html->url('/img/' . $prestador['Prestador']['foto']) ?>" alt="">
                                    <?php else: ?>
                                        <div class="iniciais">
                                            <span class="letras">
                                                <?= h($prestador['Prestador']['iniciais']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="info-prestador">
                                        <strong><?= h($prestador['Prestador']['nome']); ?></strong><br>
                                        <small><?= h($prestador['Prestador']['email']); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?= h($prestador['Prestador']['telefone']); ?>
                            </td>
                            <td>
                                <?php foreach ($prestador['PrestadorServico'] as $ps): ?>

                                    <?= h($ps['Servico']['descricao']); ?>  
                                    –  
                                    <strong>R$ <?= number_format($ps['valor'], 2, ',', '.'); ?></strong>

                                    <br>

                                <?php endforeach; ?>
                            </td>
                            <td>
                                <a class="link" href="<?php echo $this->Html->url([
                                    'controller' => 'admin',
                                    'action' => 'editarPrestador',
                                    $prestador['Prestador']['id']
                                ]); ?>">
                                    <svg class="icon editar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#535862" d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006z"/><path fill="#535862" d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2"/></svg>
                                </a>
                                <a class="link" href="">
                                    <svg class="icon escluir" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke="#535862" stroke-linejoin="round" stroke-width="4"><path d="M9 10v34h30V10z"/><path stroke-linecap="round" d="M20 20v13m8-13v13M4 10h40"/><path d="m16 10l3.289-6h9.488L32 10z"/></g></svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginacao">
                <ul class="pagination">
                    <?= $this->Paginator->prev('« Anterior', ['tag' => 'li'], null, ['tag' => 'li', 'class' => 'disabled']) ?>
                    <?= $this->Paginator->numbers(['tag' => 'li', 'currentClass' => 'active']) ?>
                    <?= $this->Paginator->next('Próximo »', ['tag' => 'li'], null, ['tag' => 'li', 'class' => 'disabled']) ?>
                </ul>
            </div>
        </div>
    </main>
    <?php
        echo $this->Html->script('https://code.jquery.com/jquery-3.7.1.min.js');
        echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js');
        echo $this->Html->script('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js');
        echo $this->Html->script('https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js');
        echo $this->Html->script('https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js');
        echo $this->Html->script('https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js');
        echo $this->Html->script('dataTable');
    ?>
</body>
</html>