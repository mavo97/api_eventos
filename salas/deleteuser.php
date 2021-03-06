<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/sala.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare evento object
$sala = new Sala($db);
 
// get evento id
$data = json_decode(file_get_contents("php://input"));
 
// set evento id to be deleted
$sala->id_sala = $data->id_sala;
$sala->id_usuario = $data->id_usuario;
 
// delete the product
if($sala->deleteUsuario()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "El usuario fue dado de baja."));
}
 
// if unable to delete the evento
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo dar de baja el usuario."));
}

?>