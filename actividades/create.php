<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;  charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate actividad object
include_once '../objects/actividades.php';
 
$database = new Database();
$db = $database->getConnection();
 
$actividad = new Actividad($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombre) &&
    !empty($data->fecha_inicio) &&
    !empty($data->fecha_fin) &&
    !empty($data->descripcion) &&
    !empty($data->id_evento)
){
 
    // set actividad property values
    $actividad->nombre = $data->nombre;
    $actividad->fecha_inicio = $data->fecha_inicio;
    $actividad->fecha_fin = $data->fecha_fin;
    $actividad->descripcion = $data->descripcion;
    $actividad->id_evento = $data->id_evento;
 
    // create the actividad
    if($actividad->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "La actividad fue creada."));
    }
 
    // if unable to create the actividad, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se pudo crear la actividad."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo crear la actividad. Datos incompletos!", $data));
}
?>