<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;  charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/sala.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$sala = new Sala($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 

if(	
	!empty($data->id_sala) &&
    !empty($data->nombre) &&
    !empty($data->ubicacion) &&
    !empty($data->estado) &&
    !empty($data->id_actividad)
){
	// set ID property of actividad to be edited
	$sala->id_sala = $data->id_sala;
	// set actividad property values
	$sala->nombre = $data->nombre;
	$sala->ubicacion = $data->ubicacion;
	$sala->estado = $data->estado;
	$sala->id_actividad = $data->id_actividad;

	// update the event
	if($sala->update()){
	 
	    // set response code - 200 ok
	    http_response_code(200);
	 
	    // tell the user
	    echo json_encode(array("message" => "La sala fue actualizada."));
	}
	 
	// if unable to update the event, tell the user
	else{
	 
	    // set response code - 503 service unavailable
	    http_response_code(503);
	 
	    // tell the user
	    echo json_encode(array("message" => "La sala no pudo ser actualizada."));
	}
}else{
	 // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar la sala. Datos incompletos!", $data));
}	
 
?>