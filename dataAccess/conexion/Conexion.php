<?php

class ConexionDB {
    private $server="localhost";
    private $database="restaurantes";
    private $username="root";
    private $password="";
    private $connection;

    public function connect(){
        $this->connection=new PDO("mysql:host=$this->server;dbname=$this->database",$this->username,$this->password);
        return $this->connection;
    }

    public function closeConnection(){
        $this->connection=null;
    }
}
?>