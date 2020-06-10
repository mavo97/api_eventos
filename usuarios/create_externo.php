<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$usuario = new Usuario($db);

 // get posted data
$data = json_decode(file_get_contents("php://input"));
  

// create the user
if(
    !empty($data->nombre) &&
    !empty($data->apellidos) &&
    !empty($data->telefono) &&
    !empty($data->correo) &&
    !empty($data->rol_usuario) &&
    !empty($data->contrasena) &&
    !empty($data->direccion)
){
 	
 	$usuario->nombre = $data->nombre;
	$usuario->apellidos = $data->apellidos;
	$usuario->telefono = $data->telefono;
	$usuario->correo = $data->correo;
	$usuario->rol_usuario = $data->rol_usuario;
    $usuario->contrasena = $data->contrasena;
    $usuario->direccion = $data->direccion;
	$email_exists = $usuario->emailExists();

	if($email_exists){
		echo json_encode(array("message" => "El correo ya esta registrado."));
	}else{
		if ($usuario->createExterno()){
		// set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode(array("message" => "Cuenta creada correctamente."));
	}	else{
		 // set response code
	    http_response_code(503);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "No se pudo crear la cuenta."));
	}
	}
    
}else{
 	// set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo crear la cuenta. Datos incompletos!", $usuario));	
   
}

?>