<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario_sala.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$usal = new UsuariosSala($db);
 

$usal->id_usuario =isset($_GET['id']) ? $_GET['id'] : die();
 
// query products
$sql = $usal->readSalasu();
$num = $sql->rowCount();
 
// check if more than 0 record found

if($num>0){
 
    // products array
    $salasUs=array();
    $salasUs["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
       $salasUs_item=array(
            "id_sala" => $id_sala,
            "id_usuario" => $id_usuario,
            "nombreSala" => $nombreSala,
            "nombreActividad" => $nombreActividad,
            "correo" => $correo,
            "estado" => $estado,
            "ubicacion" => $ubicacion,
            "nombreEvento" => $nombreEvento,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin
        );
 
        array_push($salasUs["records"], $salasUs_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($salasUs);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "El usuario no tiene salas.")
    );
}
?>