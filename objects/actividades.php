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

    // create event
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
}
?>