<?php
class Evento{
 
    // database connection and table name
    private $conn;
    private $table_name = "eventos";
 
    // object properties
    public $id_evento;
    public $id_usuario;
    public $nombre;
    public $fecha_inicio;
    public $fecha_fin;
    public $ubicacion;
    public $costo;
    public $estado;
    public $descripcion;
    public $cupo;
    public $contador;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create event
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(nombre, fecha_inicio, fecha_fin, 
                    ubicacion, costo, estado, descripcion, cupo) VALUES (?,?,?,?,?,?,?,?);";
    
        // prepare query
        $sql = $this->conn->prepare($query);
    
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->fecha_inicio=htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin=htmlspecialchars(strip_tags($this->fecha_fin));
        $this->ubicacion=htmlspecialchars(strip_tags($this->ubicacion));
        $this->costo=htmlspecialchars(strip_tags($this->costo));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->cupo=htmlspecialchars(strip_tags($this->cupo));

        // bind values
        $sql->bindParam(1, $this->nombre,PDO::PARAM_STR);
        $sql->bindParam(2, $this->fecha_inicio, PDO::PARAM_STR);
        $sql->bindParam(3, $this->fecha_fin, PDO::PARAM_STR);
        $sql->bindParam(4, $this->ubicacion, PDO::PARAM_STR);
        $sql->bindParam(5, $this->costo, PDO::PARAM_STR);
        $sql->bindParam(6, $this->estado, PDO::PARAM_STR);
        $sql->bindParam(7, $this->descripcion, PDO::PARAM_STR);
        $sql->bindParam(8, $this->cupo, PDO::PARAM_STR);
    
        // execute query
        if($sql->execute()){
            return true;
        }
    
        return false;
        
    }
    function read(){
 
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " WHERE estado = 'A'
                ORDER BY
                    fecha_inicio ASC";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // execute query
        $sql->execute();
     
        return $sql;
    }

    function read2(){
 
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " WHERE estado = 'I'
                ORDER BY
                    fecha_inicio ASC";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // execute query
        $sql->execute();
     
        return $sql;
    }

    function availables(){
 
        // select all query
        $query = "SELECT e.id_evento, e.nombre, e.fecha_inicio, e.fecha_fin, e.ubicacion, e.costo, e.estado, e.descripcion,
        e.cupo,
        count(ue.id_evento) as contador from eventos e JOIN usuarios_evento ue ON e.id_evento = ue.id_evento
     GROUP BY e.id_evento UNION SELECT e.id_evento, e.nombre, e.fecha_inicio, e.fecha_fin, e.ubicacion,
        e.costo, e.estado, e.descripcion, e.cupo, count(ue.id_evento) as contador
 FROM eventos e LEFT JOIN usuarios_evento ue
 ON e.id_evento = ue.id_evento
 WHERE ue.id_evento IS NULL OR ue.id_evento = 1 GROUP BY e.id_evento";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // execute query
        $sql->execute();
     
        return $sql;
    }

    // delete the product
    function delete(){
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_evento = ?";
     
        // prepare query
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));
     
        // bind id of record to delete
        $sql->bindParam(1, $this->id_evento);
     
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
                    id_evento = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_evento);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        $row = $sql->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->id_evento = $row['id_evento'];
        $this->nombre = $row['nombre'];
        $this->fecha_inicio = $row['fecha_inicio'];
        $this->fecha_fin = $row['fecha_fin'];
        $this->costo = $row['costo'];
        $this->estado = $row['estado'];
        $this->descripcion = $row['descripcion'];
        $this->ubicacion = $row['ubicacion'];
        $this->cupo = $row['cupo'];
    }
    // update the evento
    function update(){
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nombre = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?,
                    ubicacion = ?,
                    costo = ?,
                    estado = ?,
                    descripcion = ?,
                    cupo = ?
                WHERE
                    id_evento = ?";
     
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->fecha_inicio=htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin=htmlspecialchars(strip_tags($this->fecha_fin));
        $this->ubicacion=htmlspecialchars(strip_tags($this->ubicacion));
        $this->costo=htmlspecialchars(strip_tags($this->costo));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));
        $this->cupo=htmlspecialchars(strip_tags($this->cupo));
     
        // bind new values
        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->fecha_inicio, PDO::PARAM_STR);
        $sql->bindParam(3, $this->fecha_fin, PDO::PARAM_STR);
        $sql->bindParam(4, $this->ubicacion, PDO::PARAM_STR);
        $sql->bindParam(5, $this->costo, PDO::PARAM_STR);
        $sql->bindParam(6, $this->estado, PDO::PARAM_STR);
        $sql->bindParam(7, $this->descripcion, PDO::PARAM_STR);
        $sql->bindParam(8, $this->cupo, PDO::PARAM_STR);
        $sql->bindParam(9, $this->id_evento, PDO::PARAM_STR);
    
        // execute the query
        if($sql->execute()){
            return true;
        }
     
        return false;
    }
    function deleteUsuario(){
     
        // delete query
        $query = "DELETE FROM usuarios_evento WHERE id_usuario = ?
        AND id_evento = ?";
     
        // prepare query
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));
        // bind id of record to delete
        $sql->bindParam(1, $this->id_usuario);
        $sql->bindParam(2, $this->id_evento);
     
        // execute query
        if($sql->execute()){
            return true;
        }
     
        return false;
         
    }
}
?>