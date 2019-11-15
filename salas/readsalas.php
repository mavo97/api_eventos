<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/sala.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$sala = new Sala($db);
 

$sala->id_actividad =isset($_GET['id']) ? $_GET['id'] : die();
 
// query products
$sql = $sala->readSalas();
$num = $sql->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $salasarr=array();
    $salasarr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $sala_item=array(
            "id_sala" => $id_sala,
            "nombre" => $nombre,
            "estado" => $estado,
            "ubicacion" => $ubicacion,
            "id_actividad" => $id_actividad
        );
 
        array_push($salasarr["records"], $sala_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($salasarr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No tiene salas.")
    );
}
?>