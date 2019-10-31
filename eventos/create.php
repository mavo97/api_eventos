<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/eventos.php';
 
$database = new Database();
$db = $database->getConnection();
 
$evento = new Evento($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombre) &&
    !empty($data->fecha_inicio) &&
    !empty($data->fecha_fin) &&
    !empty($data->ubicacion) &&
    !empty($data->costo) &&
    !empty($data->estado) &&
    !empty($data->descripcion)
){
 
    // set event property values
    $evento->nombre = $data->nombre;
    $evento->fecha_inicio = $data->fecha_inicio;
    $evento->fecha_fin = $data->fecha_fin;
    $evento->ubicacion = $data->ubicacion;
    $evento->costo = $data->costo;
    $evento->estado = $data->estado;
    $evento->descripcion = $data->descripcion;
 
    // create the event
    if($evento->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "El evento fue creado."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se pudo crear el evento." ));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo crear el evento. Datos incompletos!", $data));
}
?>