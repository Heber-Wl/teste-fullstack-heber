<?php

Router::connect('/', array(
	'controller' => 'login',
	'action' => 'login'
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
require CAKE . 'Config' . DS . 'routes.php';
