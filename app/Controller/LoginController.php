<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

Class LoginController extends AppController {

    public function login() {
        $this->layout = 'mensagens';
    }

    public function loginAdmin() {
        $this->autoRender = false;
        $this->loadModel('Admin');

        if (!$this->request->is('post')) {
            return $this->redirect('/');
        }

        $email = $this->request->data['Admin']['email'];
        $senha = $this->request->data['Admin']['senha'];

        $admin = $this->Admin->find('first', [
            'conditions' => [
                'Admin.email' => $email
            ]
        ]);

        if (!$admin) {
            $this->Session->setFlash('Usuário ou senha incorretos!', 'error');
            return $this->redirect('/');
        }

        $senhaHash = Security::hash($senha, 'sha256', true);

        if ($senhaHash !== $admin['Admin']['senha']) {
            $this->Session->setFlash('Usuário ou senha incorretos!', 'error');
            return $this->redirect('/');
        }

        $this->Session->write('Admin', [
            'id'    => $admin['Admin']['id'],
            'nome'  => $admin['Admin']['nome'],
            'email' => $admin['Admin']['email']
        ]);

        $this->Session->setFlash('Bem vindo(a)!.', 'success');
        return $this->redirect('/home');
    }
    public function logout() {
        $this->Session->delete('Admin');

        $this->Session->setFlash('Você saiu!.', 'success');
        return $this->redirect('/');
    }

}