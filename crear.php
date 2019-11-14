<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/db.php';
 
// instantiate product object
include_once '../obj/lectura.php';
 
$database = new Database();
$db = $database->getConnection();
 
$lectura = new Lectura($db);
 

$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->numero_lectura) &&
    !empty($data->valor) &&
    !empty($data->fecha) &&
    !empty($data->hora)
){
 
    
   
    $lectura->valor = $data->valor;
    $lectura->fecha= $data->fecha;
    $lectura->data_id = $data->hora;
 
 
    // create the product
    if($lectura->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Lectura guardada correctamente."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "No se pudo realizar la conexion"));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
   // echo json_encode(array("message" => "No se pudo crear el registro"));
  //  echo var_dump($lectura);
    echo var_dump($data);

}
?>