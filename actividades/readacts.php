<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/actividades.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$actividad = new Actividad($db);
 

$actividad->id_evento =isset($_GET['id']) ? $_GET['id'] : die();
 
// query products
$sql = $actividad->readActivities();
$num = $sql->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $actividadesarr=array();
    $actividadesarr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $actividad_item=array(
            "id_actividad" => $id_actividad,
            "nombre" => $nombre,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "descripcion" => $descripcion,
            "id_evento" => $id_evento
        );
 
        array_push($actividadesarr["records"], $actividad_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data
    echo json_encode($actividadesarr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No tiene actividades.")
    );
}
?>