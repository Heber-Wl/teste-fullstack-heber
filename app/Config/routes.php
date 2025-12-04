<?php

Router::connect('/', array(
	'controller' => 'login',
	'action' => 'login'
));
Router::connect('/cadastro', array(
	'controller' => 'usuario',
	'action' => 'cadastrarUsuario'
));
require CAKE . 'Config' . DS . 'routes.php';
