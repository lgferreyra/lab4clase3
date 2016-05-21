<?php 
require_once (__DIR__.'/AccesoDatos.php');
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $username;
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
	public function GetUsername()
	{
		return $this->username;
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
	public function SetUsername($valor)
	{
		$this->username = $valor;
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
	public function __construct($username=NULL, $pass=NULL)
	{
		if($username != NULL && $pass != NULL){
			$obj = Usuario::VerificarUsuario($username,$pass);
			
			$this->id= $obj->id;
			$this->username = $username;
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
	  	return $this->username."-".$this->nombre."-".$this->apellido."-".$this->email."-".$this->categoria;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function VerificarUsuario($usernameParametro,$passParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where username = :username and pass = :pass");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL VerificarUsuario(:username,:pass)");
		$consulta->bindValue(':username', $usernameParametro, PDO::PARAM_STR);
		$consulta->bindValue(':pass', $passParametro, PDO::PARAM_STR);
		$consulta->execute();
		$usuarioBuscado= $consulta->fetchObject('usuario');
		return $usuarioBuscado;	
					
	}
	
	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodosLosUsuarios() ");
		$consulta->execute();			
		$arrUsuario= $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");	
		return $arrUsuario;
	}
	
	public static function BorrarUsuario($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from usuario	WHERE id=:id");	
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarUsuario(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarUsuario($usuario)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta =$objetoAccesoDato->RetornarConsulta("update usuario 
				set username=:username,
                pass=:pass,
                nombre=:nombre,
				apellido=:apellido,
				categoria=:categoria,
                email=:email
				WHERE id=:id");	 
			//$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarUsuario(:id,:username,:pass,:nombre,:apellido,:categoria,:email)");
			$consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);
			$consulta->bindValue(':username',$usuario->username, PDO::PARAM_STR);
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
		$consulta =$objetoAccesoDato->RetornarConsulta("insert into usuario(username,pass,nombre,apellido,categoria,email)
			values (:username,:pass,:nombre,:apellido,:categoria,:email");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarUsuario(:username,:pass,:nombre,:apellido,:categoria,:email)");
		$consulta->bindValue(':username',$usuario->username, PDO::PARAM_STR);
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
