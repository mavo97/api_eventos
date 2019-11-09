<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/eventos.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare evento object
$evento = new Evento($db);
 
// set ID property of record to read
$evento->id_evento = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$evento->readOne();
 
if($evento->nombre!=null){
    // create array
    $evento_arr = array(
        "id_evento" =>  $evento->id_evento,
        "nombre" => $evento->nombre,
        "fecha_inicio" => $evento->fecha_inicio,
        "fecha_fin" => $evento->fecha_fin,
        "ubicacion" => $evento->ubicacion,
        "costo" => $evento->costo,
        "estado" => $evento->estado,
        "descripcion" => $evento->descripcion
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($evento_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "El evento no existe."));
}
?>