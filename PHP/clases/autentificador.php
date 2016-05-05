<?php 
include "JWT.php";
include "BeforeValidException.php";
include "SignatureInvalidException.php";
include "ExpiredException.php";

$token = array(
	"exp"=>time()+10000,
	"id"=>666,
	"nombre"=>"Leonardo",
	"mail"=>"leonardogferreyra@gmail.com",
	"categoria"=>"administrador",
	);

$token = Firebase\JWT\JWT::encode($token,"leonardo25");
$array["tokentest"] = $token;

echo json_encode($array);

 ?>