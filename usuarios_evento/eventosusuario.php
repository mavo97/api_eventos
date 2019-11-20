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
$useven = new UsuariosEvento($db);
 

$useven->id_usuario =isset($_GET['id']) ? $_GET['id'] : die();
 
// query products
$sql = $useven->readEventosu();
$num = $sql->rowCount();
 
// check if more than 0 record found

if($num>0){
 
    // products array
    $eventsUs=array();
    $eventsUs["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
       $eventsUs_item=array(
            "id_evento" => $id_evento,
            "id_usuario" => $id_usuario,
            "nombre" => $nombre,
            "correo" => $correo,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "estado" => $estado,
            "descripcion" => $descripcion,
            "ubicacion" => $ubicacion

        );
 
        array_push($eventsUs["records"], $eventsUs_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($eventsUs);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "EL usuario no tiene eventos.")
    );
}
?>