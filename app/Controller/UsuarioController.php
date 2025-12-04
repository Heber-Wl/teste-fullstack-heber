<?php

Class UsuarioController extends AppController {

    public $uses = ['Prestador'];

    public function cadastrarUsuario() {
        $this->layout = false;
    }

    public function cadastroUsuario() {
        $this->layout = false;
        
        if ($this->request->is('post')) {

            if ($this->request->data['Prestador']['password'] !== $this->request->data['Prestador']['confirm_password']) {
                $this->Flash->error('As senhas não coincidem.');
                return;
            }

            $this->Prestador->create();

            if ($this->Prestador->save($this->request->data)) {

                $this->Flash->success('Conta criada com sucesso!');
                return $this->redirect('/');
            }

            $this->Flash->error('Erro ao cadastrar. Verifique os dados');
        }
    }
}