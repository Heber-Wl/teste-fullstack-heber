<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

Class UsuarioController extends AppController {

    public $uses = ['Prestador', 'Servico'];

    public function cadastrarUsuario() {
        if (!$this->Session->check('Admin')) {

            $this->Session->setFlash('Você precisa fazer login!.', 'error');
            return $this->redirect('/');
        }
        $this->layout = 'mensagens';

        $servicos = $this->Servico->find('list', [
            'fields' => ['Servico.id', 'Servico.descricao'],
            'order' => ['Servico.descricao' => 'ASC']
        ]);

        $this->set('servicos', $servicos);
    }

    public function cadastroUsuario() {
        $this->layout = 'mensagens';

        if ($this->request->is('post')) {

            if ($this->request->data['Prestador']['password'] !== $this->request->data['Prestador']['confirm_password']) {
                $this->Session->setFlash('As senhas não coincidem.', 'error');
                return $this->redirect($this->referer());
            }

            $fotoPathRelativa = null;

            if (!empty($this->request->data['Prestador']['foto']['name'])) {

                $arquivo = $this->request->data['Prestador']['foto'];

                if ($arquivo['error'] !== UPLOAD_ERR_OK) {
                    $this->Session->setFlash('Erro no upload da foto.', 'error');
                    return $this->redirect($this->referer());
                }

                $maxSize = 2 * 1024 * 1024;
                $allowed = ['image/jpeg', 'image/png', 'image/webp'];

                if ($arquivo['size'] > $maxSize) {
                    $this->Session->setFlash('Imagem muito grande. Máx 2MB.', 'error');
                    return $this->redirect($this->referer());
                }

                if (!in_array($arquivo['type'], $allowed)) {
                    $this->Session->setFlash('Tipo de arquivo não permitido. Apenas JPG, PNG, WEBP.', 'error');
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
                    $this->Session->setFlash('Não foi possível salvar a imagem.', 'error');
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

                $this->Session->setFlash('Conta criada com sucesso!', 'success');
                return $this->redirect('/home');
            }

            $this->Session->setFlash('Erro ao cadastrar. Verifique os dados', 'error');
            return $this->redirect($this->referer());
        }
    }

    public function cadastrarAdmin() {

        $this->layout = 'mensagens';
    }
    public function cadastroAdmin()
    {
        $this->autoRender = false;
        $this->loadModel('Admin');

        if (!$this->request->is('post')) {
            return $this->redirect('/');
        }

        if (!isset($this->request->data['Admin'])) {
            $this->Session->setFlash('Erro: dados inválidos enviados.', 'error');
            return $this->redirect('/cadastrar-admin');
        }

        $data = $this->request->data['Admin'];

        if ($data['password'] !== $data['confirm_password']) {
            $this->Session->setFlash('As senhas não coincidem.', 'error');
            return $this->redirect('/cadastrar-admin');
        }

        if (strlen($data['password']) < 8) {
            $this->Session->setFlash('A senha deve ter ao menos 8 caracteres.', 'error');
            return $this->redirect('/cadastrar-admin');
        }

        $senhaHash = Security::hash($data['password'], 'sha256', true);

        $admin = [
            'Admin' => [
                'nome'    => $data['nome'],
                'email'   => $data['email'],
                'senha'   => $senhaHash,
                'created' => date('Y-m-d H:i:s'),
                'modified'=> date('Y-m-d H:i:s')
            ]
        ];

        $this->Admin->create();

        if ($this->Admin->save($admin)) {
            $this->Session->setFlash('Administrador cadastrado com sucesso!', 'success');
            return $this->redirect('/');
        } else {
            $this->Session->setFlash('Erro ao cadastrar administrador.', 'error');
            return $this->redirect('/cadastrar-admin');
        }
    }
}