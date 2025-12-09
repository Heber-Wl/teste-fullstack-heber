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

    public function importar() {
        $this->layout = 'mensagens';

        if (!$this->request->is('post')) {
            $this->Session->setFlash('Requisição inválida.', 'error');
            return $this->redirect('/home');
        }

        $arquivo = $this->request->data['Import']['arquivo'] ?? null;

        if (!$arquivo || $arquivo['error'] !== 0) {
            $this->Session->setFlash('Nenhum arquivo enviado ou arquivo inválido.', 'error');
            return $this->redirect('/home');
        }

        $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, ['csv'])) {
            $this->Session->setFlash('Formato inválido. Envie CSV.', 'error');
            return $this->redirect('/home');
        }

        if ($ext === 'csv') {
            $dados = $this->importarCSV($arquivo['tmp_name']);
        }

        if (!$dados) {
            $this->Session->setFlash('Erro lendo o arquivo.', 'error');
            return $this->redirect('/home');
        }

        $this->loadModel('Prestador');
        $this->loadModel('PrestadorServico');

        foreach ($dados as $linha) {

            if (empty($linha['nome']) || empty($linha['email'])) {
                continue;
            }

            $this->Prestador->create();
            if ($this->Prestador->save([
                'nome' => $linha['nome'],
                'iniciais' => strtoupper(substr($linha['nome'], 0, 2)),
                'email' => $linha['email'],
                'telefone' => $linha['telefone'] ?? '',
                'password' => '123456',
            ])) {
                $prestadorId = $this->Prestador->id;

                if (!empty($linha['servico_id'])) {
                    $this->PrestadorServico->create();
                    $this->PrestadorServico->save([
                        'prestador_id' => $prestadorId,
                        'servico_id' => $linha['servico_id'],
                        'valor' => $linha['valor'] ?? 0,
                        'status_id' => 1
                    ]);
                }
            }
        }

        $this->Session->setFlash('Importação concluída!', 'success');
        return $this->redirect('/home');
    }

    private function importarCSV($caminho) {
        $linhas = [];
        $header = [];

        $this->loadModel('Servico');

        if (($handle = fopen($caminho, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if (empty($header)) {
                    $header = $data;
                    continue;
                }

                $linha = array_combine($header, $data);

                $nomeServico = trim($linha['servico']);

                $servico = $this->Servico->find('first', [
                    'conditions' => ['Servico.descricao' => $nomeServico],
                    'recursive' => -1
                ]);

                if (!$servico) {
                    $servico = $this->Servico->find('first', [
                        'conditions' => ['Servico.descricao LIKE' => '%' . $nomeServico . '%'],
                        'recursive' => -1
                    ]);
                }

                $linha['servico_id'] = $servico['Servico']['id'] ?? null;

                $linhas[] = $linha;
            }
            fclose($handle);
        }

        return $linhas;
    }
}