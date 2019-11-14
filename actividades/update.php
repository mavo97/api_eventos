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
include_once '../objects/actividades.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$actividad = new Actividad($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 

if(	
	!empty($data->id_actividad) &&
    !empty($data->nombre) &&
    !empty($data->fecha_inicio) &&
    !empty($data->fecha_fin) &&
    !empty($data->descripcion) &&
    !empty($data->id_evento)
){
	// set ID property of actividad to be edited
	$actividad->id_actividad = $data->id_actividad;
	// set actividad property values
	$actividad->nombre = $data->nombre;
	$actividad->fecha_inicio = $data->fecha_inicio;
	$actividad->fecha_fin = $data->fecha_fin;
	$actividad->id_evento = $data->id_evento;
	$actividad->descripcion = $data->descripcion;
	// update the event
	if($actividad->update()){
	 
	    // set response code - 200 ok
	    http_response_code(200);
	 
	    // tell the user
	    echo json_encode(array("message" => "La actividad fue actualizada."));
	}
	 
	// if unable to update the event, tell the user
	else{
	 
	    // set response code - 503 service unavailable
	    http_response_code(503);
	 
	    // tell the user
	    echo json_encode(array("message" => "La actividad no pudo ser actualizada."));
	}
}else{
	 // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar la actividad. Datos incompletos!", $data));
}	
 
?>