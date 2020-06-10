<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$user = new Usuario($db);
 
 
// query products
$sql = $user->readUsers();
$num = $sql->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $usersarr=array();
    $usersarr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $user_item=array(
            "id_usuario" => $id_usuario,
            "nombre" => $nombre,
            "apellidos" => $apellidos,
            "telefono" => $telefono,
            "correo" => $correo,
            "rol_usuario" => $rol_usuario
        );
 
        array_push($usersarr["records"], $user_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($usersarr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No hay usuarios registrados.")
    );
}
?>