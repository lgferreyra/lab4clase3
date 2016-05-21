<?php
class AccesoDatos
{
    

    private static $ObjetoAccesoDatos;
    private $objetoPDO;
    
    private function __construct()
    {
        $dbhost = "mysql.hostinger.com.ar";
        $dbname = "u488730980_lab4";
        $dbuser = "u488730980_lab4";
        $dbpswd = "facil1";
        try { 
            $this->objetoPDO = new PDO("mysql:host=".$dbhost.";dbname=".$dbname,$dbuser,$dbpswd, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }
    
     public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }
}
?>