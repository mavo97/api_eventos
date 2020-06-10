<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/eventos.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$evento = new Evento($db);
 
// read products will be here
$sql = $evento->availables();
$num = $sql->rowCount();
// check if more than 0 record found
if($num>0){
 
    // eventoos array
    $eventos_arr=array();
    $eventos_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $evento_item=array(
            "id_evento" => $id_evento,
            "nombre" => $nombre,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "ubicacion" => $ubicacion,
            "costo" => $costo,
            "estado" => $estado,
            "descripcion" => $descripcion,
            "cupo" => $cupo,
            "contador" => $contador
        );
 
        array_push($eventos_arr["records"], $evento_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show events data in json format
    echo json_encode($eventos_arr);
    header('Content-Type: application/json');



    // no products found will be here
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no events found
    echo json_encode(
        array("message" => "Eventos no encontrados.")
    );
}
 
?>