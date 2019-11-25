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
include_once '../objects/usuario_sala.php';
 
$database = new Database();
$db = $database->getConnection();
 
$usal = new UsuariosSala($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->id_sala) &&
    !empty($data->id_usuario) 
){
 
    // set event property values
    $usal->id_usuario = $data->id_usuario;
    $usal->id_sala = $data->id_sala;

    if($usal->usuarioRegistrado()){
        echo json_encode(array("message" => "Ya estas registrado a la sala."));
    }else{
        // create the actividad
        if($usal->registrar()){
     
            // set response code - 201 created
            http_response_code(201);
     
            // tell the user
            echo json_encode(array("message" => "Haz sido registrado a la sala."));
        }
     
        // if unable to create the actividad, tell the user
        else{
     
            // set response code - 503 service unavailable
            http_response_code(503);
     
            // tell the user
            echo json_encode(array("message" => "No haz podido ser registrado a la sala." ));
        }
    }
 
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No te puedes registrar a la sala. Datos incompletos!", $data));
}
?>