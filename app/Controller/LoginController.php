<?php

Class LoginController extends AppController {

    public function login() {
        $this->layout = false;
        $this->set('login', 'Faça Login');
    }
}