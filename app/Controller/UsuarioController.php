<?php

Class UsuarioController extends AppController {

    public $uses = ['Prestador', 'Servico'];

    public function cadastrarUsuario() {
        $this->layout = false;

        $servicos = $this->Servico->find('list', [
            'fields' => ['Servico.id', 'Servico.descricao'],
            'order' => ['Servico.descricao' => 'ASC']
        ]);

        $this->set('servicos', $servicos);
    }

    public function cadastroUsuario() {
        $this->layout = false;

        if ($this->request->is('post')) {

            if ($this->request->data['Prestador']['password'] !== $this->request->data['Prestador']['confirm_password']) {
                $this->Flash->error('As senhas não coincidem.');
                return $this->redirect($this->referer());
            }

            $fotoPathRelativa = null;

            if (!empty($this->request->data['Prestador']['foto']['name'])) {

                $arquivo = $this->request->data['Prestador']['foto'];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    $this->Flash->error('Erro no upload da foto.');
                    return $this->redirect($this->referer());
                }

                $maxSize = 2 * 1024 * 1024;
                $allowed = ['image/jpeg', 'image/png', 'image/webp'];

                if ($arquivo['size'] > $maxSize) {
                    $this->Flash->error('Imagem muito grande. Máx 2MB.');
                    return $this->redirect($this->referer());
                }

                if (!in_array($arquivo['type'], $allowed)) {
                    $this->Flash->error('Tipo de arquivo não permitido. Apenas JPG, PNG, WEBP.');
                    return $this->redirect($this->referer());
                }

                App::uses('Folder', 'Utility');
                App::uses('File', 'Utility');

                $uploadDir = WWW_ROOT . 'img' . DS . 'uploads' . DS . 'prestadores' . DS;
                $folder = new Folder($uploadDir, true, 0755);

                $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
                $nomeArquivo = time() . '_' . substr(sha1(uniqid()), 0, 6) . '.' . $ext;
                $destino = $uploadDir . $nomeArquivo;

                if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
                    $this->Flash->error('Não foi possível salvar a imagem.');
                    return $this->redirect($this->referer());
                }

                $fotoPathRelativa = 'uploads/prestadores/' . $nomeArquivo;
            }

            unset($this->request->data['Prestador']['confirm_password']);

            if (!$fotoPathRelativa) {
                unset($this->request->data['Prestador']['foto']);
            } else {
                $this->request->data['Prestador']['foto'] = $fotoPathRelativa;
            }

            $this->Prestador->create();

            if ($this->Prestador->save($this->request->data)) {

                $prestadorId = $this->Prestador->id;

                $this->loadModel('PrestadorServico');

                if (!empty($this->request->data['PrestadorServico']['servico'])) {
                    foreach ($this->request->data['PrestadorServico']['servico'] as $servico) {
                        if (!empty($servico['id'])) {
                            $this->PrestadorServico->create();
                            $this->PrestadorServico->save([
                                'prestador_id' => $prestadorId,
                                'servico_id'   => $servico['id'],
                                'valor'        => !empty($servico['valor']) ? $servico['valor'] : 0,
                                'status_id'    => 1
                            ]);
                        }
                    }
                }

                $this->Flash->success('Conta criada com sucesso!');
                return $this->redirect('/home');
            }

            $this->Flash->error('Erro ao cadastrar. Verifique os dados');
            return $this->redirect($this->referer());
        }
    }
}