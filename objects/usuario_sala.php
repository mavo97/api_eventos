<?php
class UsuariosSala{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuarios_sala";
 
    // object properties
    public $id_sala;
    public $id_usuario;
    public $nombre;
    public $correo;
    public $fecha_inicio;
    public $fecha_fin;
    public $ubicacion;
    public $costo;
    public $estado;
    public $descripcion;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // registrar usuarios_evento
    function registrar(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(id_sala, id_usuario) VALUES (?,?);";
    
        // prepare query
        $sql = $this->conn->prepare($query);
    
        // sanitize
        $this->id_sala=htmlspecialchars(strip_tags($this->id_sala));
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
    
        // bind values
        $sql->bindParam(1, $this->id_sala,PDO::PARAM_STR);
        $sql->bindParam(2, $this->id_usuario, PDO::PARAM_STR);
       
    
        // execute query
        if($sql->execute()){
            return true;
        }
    
        return false;
        
    }
    function usuarioRegistrado(){

    $query = "SELECT id_usuario, id_sala FROM " . $this->table_name . "
            WHERE id_usuario = ? AND id_sala = ?
            LIMIT 0,1";

    $sql = $this->conn->prepare( $query );

    $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
    $this->id_evento=htmlspecialchars(strip_tags($this->id_sala));

    $sql->bindParam(1, $this->id_usuario);
    $sql->bindParam(2, $this->id_sala);

    $sql->execute();

    $num = $sql->rowCount();

    if($num>0){

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $this->id_usuario = $row['id_usuario'];
        $this->id_sala = $row['id_sala'];

        return true;
    }

    return false;
    }
   function readSalasu(){
     
        // query to read single record

        $query = "SELECT u.correo, s.nombre as nombreSala, us.id_sala, us.id_usuario,
        s.estado, s.ubicacion, e.nombre as nombreEvento, a.nombre as nombreActividad,
        a.fecha_inicio, a.fecha_fin
            FROM
                 usuarios u
            INNER JOIN
                 usuarios_sala us on u.id_usuario = us.id_usuario
            LEFT JOIN 
                 sala_taller s on s.id_sala = us.id_sala
            LEFT JOIN
                 actividades a on a.id_actividad = s.id_actividad
            LEFT JOIN eventos e on e.id_evento = a.id_evento

            WHERE 
                 u.id_usuario = ? AND s.estado = 'A' ";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_usuario);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        return $sql;
     


    }
    function usEnSala(){
     
        // query to read single record

        $query = "SELECT u.correo, u.apellidos, u.nombre as nombreUsuario,
         us.id_sala, us.id_usuario
            FROM
                 usuarios u
            INNER JOIN
                 usuarios_sala us on u.id_usuario = us.id_usuario
            LEFT JOIN
                 sala_taller s on s.id_sala = us.id_sala

            WHERE
                 s.id_sala = ? ";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_sala);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        return $sql;
     
    }
    
}
?>