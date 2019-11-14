<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
include_once '../config/db.php';
include_once '../obj/temperatura.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$lectura = new temperatura($db);
 
// query products
$stmt = $lectura->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $lectura_arr=array();
    $lectura_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $lectura_item=array(
            
            "valor" => $valor,
            "fecha" => $fecha,
            "hora" => $hora
        );
 
        array_push($lectura_arr["records"], $lectura_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($lectura_arr);
}
 
else{
 
   
    http_response_code(404);
 
    
    echo json_encode(
        array("message" => "No Se encontraron lecturas.")
    );
}