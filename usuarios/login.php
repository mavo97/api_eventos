<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here
// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$usuario = new Usuario($db);
 
// check email existence here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$usuario->correo = $data->correo;
$email_exists = $usuario->emailExists();
 
// files for jwt will be here
// generate json web token
include_once '../config/core.php';
include_once '../libs/BeforeValidException.php';
include_once '../libs/ExpiredException.php';
include_once '../libs/SignatureInvalidException.php';
include_once '../libs/JWT.php';
use \Firebase\JWT\JWT;
 
// generate jwt will be here
// check if email exists and if password is correct
if($email_exists && password_verify($data->contrasena, $usuario->contrasena)){
 
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "id_usuario" => $usuario->id_usuario,
           "nombre" => $usuario->nombre,
           "apellidos" => $usuario->apellidos,
           "correo" => $usuario->correo,
           "contrasena" => $usuario->contrasena,
           "telefono" => $usuario->telefono,
           "rol_usuario" => $usuario->rol_usuario
       )
    );
 
    // set response code
    http_response_code(200);
 
    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Inicio de sesión exitoso.",
                "jwt" => $jwt
            )
        );
 
}
 
// login failed will be here
// login failed
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("message" => "Inicio de sesión erroneo."));
}
?>