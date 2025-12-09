<?php

Class AdminController extends AppController {

    public function paginaInicial() {
        $this->layout = 'mensagens';

        $this->loadModel('Prestador');
        $this->loadModel('Servico');

        $prestadores = $this->Prestador->find('all', [
            'recursive' => 2,
            'order' => ['Prestador.nome' => 'ASC']
        ]);
        foreach ($prestadores as &$p) {
            $p['Prestador']['iniciais'] =
                $this->Prestador->resgatarPrimeirosDuasLetras($p['Prestador']['nome']);
        }
        
        $servicos = $this->Servico->find('all', [
            'order' => ['Servico.descricao' => 'ASC']
        ]);

        $this->set([
            'prestadores' => $prestadores,
            'servicos' => $servicos
        ]);
    }
}