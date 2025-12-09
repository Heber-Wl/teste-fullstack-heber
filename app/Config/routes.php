<?php

Router::connect('/', array(
	'controller' => 'login',
	'action' => 'login'
));
Router::connect('/login-admin', [
    'controller' => 'login',
    'action' => 'loginAdmin'
]);
Router::connect('/logout', [
	'controller' => 'login', 
	'action' => 'logout'
]);
Router::connect('/cadastrar-admin', array(
	'controller' => 'usuario',
	'action' => 'cadastrarAdmin'
));
Router::connect('/cadastro-admin', array(
	'controller' => 'usuario',
	'action' => 'cadastroAdmin'
));
Router::connect('/cadastrar', array(
	'controller' => 'usuario',
	'action' => 'cadastrarUsuario'
));
Router::connect('/cadastro', array(
	'controller' => 'usuario',
	'action' => 'cadastroUsuario'
));
Router::connect('/home', array(
	'controller' => 'admin',
	'action' => 'paginaInicial'
));
Router::connect('/importar', [
    'controller' => 'admin',
    'action' => 'importar'
]);
Router::connect('/editar-prestador/:id', array(
	'controller' => 'admin',
	'action' => 'aditarPrestador',
	'pass' => ['id'], 'id' => '[0-9]+'
));
Router::connect(
    '/admin/atualizar-prestador',
    [
        'controller' => 'admin',
        'action' => 'atualizarPrestador'
    ]
);
require CAKE . 'Config' . DS . 'routes.php';
