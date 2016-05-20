<?php 
	require_once"Usuarios.php";

	$usuario = new Usuario();
	$usuario->user="probando";
	$usuario->pass="probando";
	$usuario->nombre="probando";
	$usuario->apellido="probando";
	$usuario->email="probando";
	$usuario->categoria="probando";

	$otro=new Usuario("probando","probando");
	$id=Usuario::BorrarUsuario($otro->id);

	$respuesta=array();
	$respuesta['listado'] = Usuario::TraerTodosLosUsuarios();
	$arrayjson=json_encode($respuesta);
	echo $arrayjson, json_encode($otro), $id;
 ?>