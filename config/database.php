<?php

require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/api_eventos');
$dotenv->load();

class Database{
 
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;
 
    // get the database connection
    public function getConnection(){

        $this->host = getenv('DDBB_HOST');
        $this->db_name  = getenv('DDBB_DBNAME');
        $this->username = getenv('DDBB_USER');
        $this->password = getenv('DDBB_PASSWORD');

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