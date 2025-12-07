<?php

Class AdminController extends AppController {

    public function paginaInicial() {
        $this->layout = false;

        $this->loadModel('Prestador');
        $this->loadModel('Servico');

        $prestadores = $this->Prestador->find('all', [
            'recursive' => 2,
            'order' => ['Prestador.nome' => 'ASC']
        ]);

        $servicos = $this->Servico->find('all', [
            'order' => ['Servico.descricao' => 'ASC']
        ]);

        $this->set([
            'prestadores' => $prestadores,
            'servicos' => $servicos
        ]);
    }
}