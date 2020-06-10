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
include_once '../objects/eventos.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$evento = new Evento($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 

if(	
	!empty($data->id_evento) &&
    !empty($data->nombre) &&
    !empty($data->fecha_inicio) &&
    !empty($data->fecha_fin) &&
    !empty($data->ubicacion) &&
    !empty($data->costo) || empty($data->costo) &&
    !empty($data->estado) &&
    !empty($data->descripcion) &&
    !empty($data->cupo)  || empty($data->cupo)
){
	// set ID property of event to be edited
	$evento->id_evento = $data->id_evento;
	// set event property values
	$evento->nombre = $data->nombre;
    $evento->fecha_inicio = $data->fecha_inicio;
    $evento->fecha_fin = $data->fecha_fin;
    $evento->ubicacion = $data->ubicacion;
    $evento->costo = $data->costo;
    $evento->estado = $data->estado;
    $evento->descripcion = $data->descripcion;
    $evento->cupo = $data->cupo;
 
	// update the event
	if($evento->update()){
	 
	    // set response code - 200 ok
	    http_response_code(200);
	 
	    // tell the user
	    echo json_encode(array("message" => "El evento fue actualizado."));
	}
	 
	// if unable to update the event, tell the user
	else{
	 
	    // set response code - 503 service unavailable
	    http_response_code(503);
	 
	    // tell the user
	    echo json_encode(array("message" => "El evento no pudo ser actualizado."));
	}
}else{
	 // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar el evento. Datos incompletos!", $data));
}	
 
?>