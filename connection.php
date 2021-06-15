<?php
if(!defined('Access')) {
        header("location: login.php");
}
class ConnectToDb{
private $servername = "localhost";
private $username = "root";
protected $password = "";
private $dbname = "bazaurzad";
private $conn;
public function makeConnection(){
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    mysqli_set_charset($this->conn,"utf8");
    $this->checkDB();
}
private function checkDB(){ 
    if ($this->conn->connect_error) {
    echo('błąd połączenia');
    header("location: login.php");
    }
}
public function doQuery($sql){
    $result = $this->conn->query($sql);
    return $result;
}
public function closeConnect(){
    $this->conn->close();
}
}