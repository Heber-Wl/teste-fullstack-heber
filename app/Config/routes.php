<?php

Router::connect('/', array(
	'controller' => 'login',
	'action' => 'login'
));
Router::connect('/cadastro', array(
	'controller' => 'usuario',
	'action' => 'cadastrarUsuario'
));
Router::connect('/home', array(
	'controller' => 'admin',
	'action' => 'paginaInicial'
));
require CAKE . 'Config' . DS . 'routes.php';
