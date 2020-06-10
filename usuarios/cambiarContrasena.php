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
    !empty($data->contrasena) &&
    !empty($data->id_usuario)
){

    $usuario->contrasena = $data->contrasena;
    $usuario->id_usuario = $data->id_usuario;

	if ($usuario->cambiarContrasena()){
		// set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode(array("message" => "Contrasena actualizada correctamente."));
	}	else{
		 // set response code
	    http_response_code(503);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "No se pudo actualizar la contraseña."));
	}
}else{
 	// set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar la contraseña. Datos incompletos!", $usuario));	
   
}

?>