<?php 

class Database{
    private $host = 'localhost';
    private $db_name = 'libreria';
    private $username = 'root';
    private $password = '';

    public $conexion;


    //funcion para gestionar la conexion base de datos

    public function getConnection(){
        $this->conexion =null;

        try{
            $this->conexion = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
            $this->conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Error de conexion: ".$exception->getMessage();
        }

        return $this->conexion;
    }
}