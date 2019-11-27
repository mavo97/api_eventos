<?php
class UsuariosEvento{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuarios_evento";
 
    // object properties
    public $id_evento;
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
                    " . $this->table_name . "(id_evento, id_usuario) VALUES (?,?);";
    
        // prepare query
        $sql = $this->conn->prepare($query);
    
        // sanitize
        $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
    
        // bind values
        $sql->bindParam(1, $this->id_evento,PDO::PARAM_STR);
        $sql->bindParam(2, $this->id_usuario, PDO::PARAM_STR);
       
    
        // execute query
        if($sql->execute()){
            return true;
        }
    
        return false;
        
    }
    function usuarioRegistrado(){

    $query = "SELECT id_usuario, id_evento FROM " . $this->table_name . "
            WHERE id_usuario = ? AND id_evento = ?
            LIMIT 0,1";

    $sql = $this->conn->prepare( $query );

    $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
    $this->id_evento=htmlspecialchars(strip_tags($this->id_evento));

    $sql->bindParam(1, $this->id_usuario);
    $sql->bindParam(2, $this->id_evento);

    $sql->execute();

    $num = $sql->rowCount();

    if($num>0){

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $this->id_usuario = $row['id_usuario'];
        $this->id_evento = $row['id_evento'];

        return true;
    }

    return false;
    }
    function readEventosu(){
     
        // query to read single record

        $query = "SELECT u.correo, e.nombre, ue.id_evento, ue.id_usuario,
        e.fecha_inicio, e.fecha_fin, e.estado, e.descripcion, e.ubicacion
            FROM
                 usuarios u
            INNER JOIN
                 usuarios_evento ue on u.id_usuario = ue.id_usuario
            LEFT JOIN 
                 eventos e on e.id_evento = ue.id_evento
            WHERE 
                 u.id_usuario = ? AND e.estado = 'A'";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_usuario);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        return $sql;
     


    }
    function usEnEvento(){
     
        // query to read single record

        $query = "SELECT u.correo, u.apellidos, u.nombre as nombreUsuario,
         ue.id_evento, ue.id_usuario
            FROM
                 usuarios u
            INNER JOIN
                 usuarios_evento ue on u.id_usuario = ue.id_usuario

            WHERE
                 ue.id_evento = ? ";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->id_evento);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        return $sql;
     
    }
}
?>