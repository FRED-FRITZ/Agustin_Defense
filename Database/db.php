<?php
include '../abstract.php';

class Database extends Db
{
    protected $conn;
    private $servername="localhost";
    private $username="root";
    private $password="";
    private $databasename="defense";

    public function dbconn(){

        $this->conn = new mysqli($this->servername,$this->username,$this->password);
        $this->conn->query("CREATE DATABASE IF NOT EXISTS $this->databasename");
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->databasename);       
    }

    public function getError(){

    return $this->conn->error;

    }

}
?>