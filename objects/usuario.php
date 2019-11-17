<?php
class Usuario{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuarios";
 
    // object properties
    public $id_usuario;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $correo;
    public $rol_usuario;
    public $contrasena;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // create new user record
    function create(){
     
        $query = "INSERT INTO " . $this->table_name . "(nombre, apellidos, telefono, correo,
        rol_usuario, contrasena) VALUES (?,?,?,?,?,?);";

     
        // prepare the query
        $sql = $this->conn->prepare($query);
     
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->rol_usuario=htmlspecialchars(strip_tags($this->rol_usuario));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));

        $hash = password_hash($this->contrasena, PASSWORD_BCRYPT);


        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->apellidos, PDO::PARAM_STR);
        $sql->bindParam(3, $this->telefono, PDO::PARAM_STR);
        $sql->bindParam(4, $this->correo, PDO::PARAM_STR);
        $sql->bindParam(5, $this->rol_usuario, PDO::PARAM_STR);
        $sql->bindParam(6, $hash, PDO::PARAM_STR);

     
       
     
        if($sql->execute()){
            return true;
        }
     
        return false;
    }
     
    // emailExists() 


}
?>