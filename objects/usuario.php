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
    
    public $no_control;
    public $carrera;
    public $rfc;
    public $ocupacion;
    public $departamento;
    public $direccion;
 
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

    // create new user record
    function createPersonal(){
     
        $query = "INSERT INTO " . $this->table_name . "(nombre, apellidos, telefono, correo,
        rol_usuario, contrasena, departamento, ocupacion, rfc) VALUES (?,?,?,?,?,?,?,?,?);";

     
        // prepare the query
        $sql = $this->conn->prepare($query);
     
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->rol_usuario=htmlspecialchars(strip_tags($this->rol_usuario));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        $this->departamento=htmlspecialchars(strip_tags($this->departamento));
        $this->ocupacion=htmlspecialchars(strip_tags($this->ocupacion));
        $this->rfc=htmlspecialchars(strip_tags($this->rfc));
        
        $hash = password_hash($this->contrasena, PASSWORD_BCRYPT);


        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->apellidos, PDO::PARAM_STR);
        $sql->bindParam(3, $this->telefono, PDO::PARAM_STR);
        $sql->bindParam(4, $this->correo, PDO::PARAM_STR);
        $sql->bindParam(5, $this->rol_usuario, PDO::PARAM_STR);
        $sql->bindParam(6, $hash, PDO::PARAM_STR);
        $sql->bindParam(7, $this->departamento, PDO::PARAM_STR);
        $sql->bindParam(8, $this->ocupacion, PDO::PARAM_STR);
        $sql->bindParam(9, $this->rfc, PDO::PARAM_STR);

     
       
     
        if($sql->execute()){
            return true;
        }
     
        return false;
    }
     
    function createAlumno(){
     
        $query = "INSERT INTO " . $this->table_name . "(nombre, apellidos, telefono, correo,
        rol_usuario, contrasena, no_control, carrera) VALUES (?,?,?,?,?,?,?,?);";

     
        // prepare the query
        $sql = $this->conn->prepare($query);
     
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->rol_usuario=htmlspecialchars(strip_tags($this->rol_usuario));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        $this->no_control=htmlspecialchars(strip_tags($this->no_control));
        $this->carrera=htmlspecialchars(strip_tags($this->carrera));
        
        $hash = password_hash($this->contrasena, PASSWORD_BCRYPT);


        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->apellidos, PDO::PARAM_STR);
        $sql->bindParam(3, $this->telefono, PDO::PARAM_STR);
        $sql->bindParam(4, $this->correo, PDO::PARAM_STR);
        $sql->bindParam(5, $this->rol_usuario, PDO::PARAM_STR);
        $sql->bindParam(6, $hash, PDO::PARAM_STR);
        $sql->bindParam(7, $this->no_control, PDO::PARAM_STR);
        $sql->bindParam(8, $this->carrera, PDO::PARAM_STR);     
       
     
        if($sql->execute()){
            return true;
        }
     
        return false;
    }

    function createExterno(){
     
        $query = "INSERT INTO " . $this->table_name . "(nombre, apellidos, telefono, correo,
        rol_usuario, contrasena, direccion) VALUES (?,?,?,?,?,?,?);";

     
        // prepare the query
        $sql = $this->conn->prepare($query);
     
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->rol_usuario=htmlspecialchars(strip_tags($this->rol_usuario));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        
        $hash = password_hash($this->contrasena, PASSWORD_BCRYPT);


        $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $sql->bindParam(2, $this->apellidos, PDO::PARAM_STR);
        $sql->bindParam(3, $this->telefono, PDO::PARAM_STR);
        $sql->bindParam(4, $this->correo, PDO::PARAM_STR);
        $sql->bindParam(5, $this->rol_usuario, PDO::PARAM_STR);
        $sql->bindParam(6, $hash, PDO::PARAM_STR);
        $sql->bindParam(7, $this->direccion, PDO::PARAM_STR);       
     
        if($sql->execute()){
            return true;
        }
     
        return false;
    }

    // emailExists() 
    function emailExists(){

    $query = "SELECT id_usuario, nombre, apellidos, telefono, correo, rol_usuario, contrasena
            FROM " . $this->table_name . "
            WHERE correo = ?
            LIMIT 0,1";

    $sql = $this->conn->prepare( $query );

    $this->correo=htmlspecialchars(strip_tags($this->correo));

    $sql->bindParam(1, $this->correo);

    $sql->execute();

    $num = $sql->rowCount();

    if($num>0){

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $this->id_usuario = $row['id_usuario'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->contrasena = $row['contrasena'];
        $this->correo = $row['correo'];
        $this->telefono = $row['telefono'];
        $this->rol_usuario = $row['rol_usuario'];


        return true;
    }

    return false;
    }
        function readUsers(){
        $query = "SELECT id_usuario, nombre, apellidos, telefono, correo, rol_usuario
            FROM
                 usuarios 
            WHERE rol_usuario != 'A' ORDER BY rol_usuario";

        $sql = $this->conn->prepare($query);
        $sql->execute();
     
    
        return $sql;
    }
    function deleteUsuario(){
     
        // delete query
        $query = "DELETE FROM usuarios WHERE id_usuario = ?";
     
        // prepare query
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        // bind id of record to delete
        $sql->bindParam(1, $this->id_usuario);
     
        // execute query
        if($sql->execute()){
            return true;
        }
     
        return false;
         
    }

    function cambiarContrasena(){
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    contrasena = ?
                WHERE
                    id_usuario = ?";
        // prepare query statement
        $sql = $this->conn->prepare($query);
     
        // sanitize
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        
        $hash = password_hash($this->contrasena, PASSWORD_BCRYPT);
        // bind new values
        $sql->bindParam(1, $hash, PDO::PARAM_STR);
        $sql->bindParam(2, $this->id_usuario, PDO::PARAM_STR);
        
      
    
        // execute the query
        if($sql->execute()){
            return true;
        }
     
        return false;

    }
 

}
?>