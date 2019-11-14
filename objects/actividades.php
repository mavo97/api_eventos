<?php
class Actividad{
 
    // database connection and table name
    private $conn;
    private $table_name = "actividades";
 
    // object properties
    public $id_actividad;
    public $nombre;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $id_evento;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create actividad
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(nombre, fecha_inicio, fecha_fin, 
                    descripcion, id_evento) VALUES (?,?,?,?,?);";
    
        // prepare query
        $sql = $this->conn->prepare($query);
    
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->fecha_inicio=htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin=htmlspecialchars(strip_tags($this->fecha_fin));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));
    
        // bind values
        $sql->bindParam(1, $this->nombre,PDO::PARAM_STR);
        $sql->bindParam(2, $this->fecha_inicio, PDO::PARAM_STR);
        $sql->bindParam(3, $this->fecha_fin, PDO::PARAM_STR);
        $sql->bindParam(4, $this->descripcion, PDO::PARAM_STR);
        $sql->bindParam(5, $this->id_evento, PDO::PARAM_STR);
    
        // execute query
        if($sql->execute()){
            return true;
        }
    
        return false;
        
    }
    function readActivities(){
 
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_evento = ?
                ORDER BY
                    fecha_inicio ASC";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        
        // bind
        $sql->bindParam(1, $this->id_evento);

     
        // execute query
        $sql->execute();
     
     
        return $sql;
    }
    function delete(){
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_actividad = ?";
     
        // prepare query
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->id_actividad=htmlspecialchars(strip_tags($this->id_actividad));
     
        // bind id of record to delete
        $sql->bindParam(1, $this->id_actividad);
     
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
                    id_actividad = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_actividad);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        $row = $sql->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->id_actividad = $row['id_actividad'];
        $this->nombre = $row['nombre'];
        $this->fecha_inicio = $row['fecha_inicio'];
        $this->fecha_fin = $row['fecha_fin'];
        $this->descripcion = $row['descripcion'];
        $this->id_evento = $row['id_evento'];
    }
    // update the actividad
    function update(){
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nombre = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?,
                    id_evento = ?,
                    descripcion = ?
                WHERE
                    id_actividad = ?";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->fecha_inicio=htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin=htmlspecialchars(strip_tags($this->fecha_fin));
        $this->id_actividad=htmlspecialchars(strip_tags($this->id_actividad));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));
     
        // bind new values
        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->fecha_inicio, PDO::PARAM_STR);
        $sql->bindParam(3, $this->fecha_fin, PDO::PARAM_STR);
        $sql->bindParam(4, $this->id_evento, PDO::PARAM_STR);
        $sql->bindParam(5, $this->descripcion, PDO::PARAM_STR);
        $sql->bindParam(6, $this->id_actividad, PDO::PARAM_STR);
     
        // execute the query
        if($sql->execute()){
            return true;
        }
     
        return false;
    }
}
?>