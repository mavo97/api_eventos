<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/actividades.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare actividad object
$actividad = new Actividad($db);
 
// set ID property of record to read
$actividad->id_actividad = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of actividad to be edited
$actividad->readOne();
 
if($actividad->nombre!=null){
    // create array
    $actividad_arr = array(
        "id_actividad" =>  $actividad->id_actividad,
        "nombre" => $actividad->nombre,
        "fecha_inicio" => $actividad->fecha_inicio,
        "fecha_fin" => $actividad->fecha_fin,
        "descripcion" => $actividad->descripcion,
        "id_evento" => $actividad->id_evento
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($actividad_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user actividad does not exist
    echo json_encode(array("message" => "La actividad no existe."));
}
?>