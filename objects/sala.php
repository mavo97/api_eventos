<?php
class Sala{
 
    // database connection and table name
    private $conn;
    private $table_name = "sala_taller";
 
    // object properties
    public $id_sala;
    public $id_actividad;
    public $nombre;
    public $estado;
    public $ubicacion;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // create sala
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(id_actividad, nombre, 
                    estado, ubicacion) VALUES (?,?,?,?);";
    
        // prepare query
        $sql = $this->conn->prepare($query);
    
        // sanitize
        $this->id_actividad=htmlspecialchars(strip_tags($this->id_actividad));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->ubicacion=htmlspecialchars(strip_tags($this->ubicacion));
    
        // bind values
        $sql->bindParam(1, $this->id_actividad, PDO::PARAM_STR);
        $sql->bindParam(2, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(3, $this->estado, PDO::PARAM_STR);
        $sql->bindParam(4, $this->ubicacion, PDO::PARAM_STR);
    
        // execute query
        if($sql->execute()){
            return true;
        }
    
        return false;
        
    }
    function readSalas(){
 
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_actividad = ?";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        
        // bind
        $sql->bindParam(1, $this->id_actividad);

     
        // execute query
        $sql->execute();
     
     
        return $sql;
    }
}
?>