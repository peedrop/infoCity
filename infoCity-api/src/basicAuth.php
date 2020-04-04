<?php

namespace src;
use Tuupola\Middleware\HttpBasicAuthentication;
use App\DAO\UsuarioDAO;

function basicAuth(): HttpBasicAuthentication
{	
	return new HttpBasicAuthentication([
		'users' => logins()
	]);
}

function logins(): array
{
	$usuarioDAO = new UsuarioDAO();  
    $usuarios = $usuarioDAO->getAll();

    $users['admin'] = 'admin';
    foreach ($usuarios as &$usuario) {
	    $users += [ $usuario['email'] => $usuario['senha'] ];
	}
	return $users;
}
