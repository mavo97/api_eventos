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
    public $id_usuario;
 
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
    // Salas para usuarios
    function readSalas(){
 
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_actividad = ? AND estado = 'A'";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        
        // bind
        $sql->bindParam(1, $this->id_actividad);

     
        // execute query
        $sql->execute();
     
     
        return $sql;
    }
    function delete(){
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sala = ?";
     
        // prepare query
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->id_sala=htmlspecialchars(strip_tags($this->id_sala));
     
        // bind id of record to delete
        $sql->bindParam(1, $this->id_sala);
     
        // execute query
        if($sql->execute()){
            return true;
        }
     
        return false;
         
    }
    function readOne(){
     
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_sala = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_sala);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        $row = $sql->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->id_sala = $row['id_sala'];
        $this->nombre = $row['nombre'];
        $this->estado = $row['estado'];
        $this->ubicacion = $row['ubicacion'];
        $this->id_actividad = $row['id_actividad'];
    }
    // update the actividad
    function update(){
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nombre = ?,
                    id_actividad = ?,
                    ubicacion = ?,
                    estado = ?
                WHERE
                    id_sala = ?";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->id_actividad=htmlspecialchars(strip_tags($this->id_actividad));
        $this->ubicacion=htmlspecialchars(strip_tags($this->ubicacion));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->id_sala=htmlspecialchars(strip_tags($this->id_sala));
     
        // bind new values
        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->id_actividad, PDO::PARAM_STR);
        $sql->bindParam(3, $this->ubicacion, PDO::PARAM_STR);
        $sql->bindParam(4, $this->estado, PDO::PARAM_STR);
        $sql->bindParam(5, $this->id_sala, PDO::PARAM_STR);
     
        // execute the query
        if($sql->execute()){
            return true;
        }
     
        return false;
    }
    function deleteUsuario(){
     
        // delete query
        $query = "DELETE FROM usuarios_sala WHERE id_usuario = ?
        AND id_sala = ?";
     
        // prepare query
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_sala=htmlspecialchars(strip_tags($this->id_sala));
        // bind id of record to delete
        $sql->bindParam(1, $this->id_usuario);
        $sql->bindParam(2, $this->id_sala);
     
        // execute query
        if($sql->execute()){
            return true;
        }
     
        return false;
         
    }
}
?>