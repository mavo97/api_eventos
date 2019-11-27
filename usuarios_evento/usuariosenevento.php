<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario_evento.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$usev = new UsuariosEvento($db);
 

$usev->id_evento =isset($_GET['id']) ? $_GET['id'] : die();
 
// query products
$sql = $usev->usEnEvento();
$num = $sql->rowCount();
 
// check if more than 0 record found

if($num>0){
 
    // products array
    $eventosUs=array();
    $eventosUs["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
       $eventosUs_item=array(
            "id_evento" => $id_evento,
            "id_usuario" => $id_usuario,
            "correo" => $correo,
            "nombreUsuario" => $nombreUsuario,
            "apellidos" => $apellidos
        );
 
        array_push($eventosUs["records"], $eventosUs_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($eventosUs);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "El evento no tiene usuarios.")
    );
}
?>