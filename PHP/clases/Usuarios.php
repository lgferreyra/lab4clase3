<?php 
require_once"accesoDatos.php";
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $user;
 	public $pass;
 	public $nombre;
 	public $apellido;
  	public $categoria;
  	public $email;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetUser()
	{
		return $this->user;
	}
	public function GetPass()
	{
		return $this->pass;
	}
	public function GetApellido()
	{
		return $this->apellido;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetCategoria()
	{
		return $this->categoria;
	}
	public function GetEmail()
	{
		return $this->email;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetUser($valor)
	{
		$this->user = $valor;
	}
	public function SetPass($valor)
	{
		$this->nombre = $pass;
	}
	public function SetApellido($valor)
	{
		$this->apellido = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetCategoria($valor)
	{
		$this->categoria = $valor;
	}
	public function SetEmail($valor)
	{
		$this->email = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($user=NULL, $pass=NULL)
	{
		if($user != NULL && $pass != NULL){
			$obj = Usuario::VerificarUsuario($user,$pass);
			
			$this->id= $obj->id;
			$this->user = $user;
			$this->pass = $pass;
			$this->nombre = $obj->nombre;
			$this->apellido = $obj->apellido;
			$this->categoria = $obj->categoria;
			$this->email = $obj->email;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->user."-".$this->nombre."-".$this->apellido."-".$this->email."-".$this->categoria;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function VerificarUsuario($userParametro,$passParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from persona where id =:id");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL VerificarUsuario(:username,:pass)");
		$consulta->bindValue(':username', $userParametro, PDO::PARAM_STR);
		$consulta->bindValue(':pass', $passParametro, PDO::PARAM_STR);
		$consulta->execute();
		$usuarioBuscado= $consulta->fetchObject('usuario');
		return $usuarioBuscado;	
					
	}
	
	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from persona");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodosLosUsuarios() ");
		$consulta->execute();			
		$arrUsuario= $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");	
		return $arrUsuario;
	}
	
	public static function BorrarUsuario($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("delete from persona	WHERE id=:id");	
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarUsuario(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarUsuario($usuario)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarUsuario(:id,:username,:pass,:nombre,:apellido,:categoria,:email)");
			$consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);
			$consulta->bindValue(':username',$usuario->user, PDO::PARAM_STR);
			$consulta->bindValue(':pass',$usuario->pass, PDO::PARAM_STR);
			$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
			$consulta->bindValue(':categoria', $usuario->categoria, PDO::PARAM_STR);
			$consulta->bindValue(':email', $usuario->email, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarUsuario($usuario)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into persona (nombre,apellido,dni,foto)values(:nombre,:apellido,:dni,:foto)");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarUsuario(:username,:pass,:nombre,:apellido,:categoria,:email)");
		$consulta->bindValue(':username',$usuario->user, PDO::PARAM_STR);
		$consulta->bindValue(':pass',$usuario->pass, PDO::PARAM_STR);
		$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':categoria', $usuario->categoria, PDO::PARAM_STR);
		$consulta->bindValue(':email', $usuario->email, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//
} 

?>
