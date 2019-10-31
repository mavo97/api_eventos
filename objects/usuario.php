<?php
class Usuario{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuarios";
 
    // object properties
    public $id_usuario;
    public $nombre;
    public $apellidos;
    public $curp;
    public $telefono;
    public $correo;
    public $rol_usuario;
    public $contrasena;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>