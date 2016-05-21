<?php 
	require (__DIR__.'/Usuarios.php');

	$usuario = new Usuario();
	$usuario->user="probando";
	$usuario->pass="probando";
	$usuario->nombre="probando";
	$usuario->apellido="probando";
	$usuario->email="probando";
	$usuario->categoria="probando";

	$id = Usuario::InsertarUsuario($usuario);
	//$id = Usuario::InsertarUsuario($usuario);

	$respuesta=array();
	$respuesta['listado'] = Usuario::TraerTodosLosUsuarios();
	$arrayjson=json_encode($respuesta);
	echo $arrayjson;
 ?>