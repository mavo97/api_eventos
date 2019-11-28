<?php
class Database{
 
    private $host = "us-cdbr-iron-east-05.cleardb.net";
    private $db_name = "heroku_672b1957c505377";
    private $username = "bba6b3588a5efb";
    private $password = "d9df1570";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>