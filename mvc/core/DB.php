<?php 
class DB{
    public $con;
    public $servername="localhost";
    public $username ="root";
    public $password="root";
    public $dbname="onlinemusicdb";
    public $port="8888";


    public function __construct(){
        $this->con = new mysqli($this->servername, $this->username, $this->password,$this->dbname,$this->port);
       
        //$this->con->set_charset("utf8");
        if ( $this->con->connect_error) {
            # code...
            die("connection failed: " .  $this->con->connect_error);
        }
    }
}
?>