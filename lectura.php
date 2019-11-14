<?php
class Lectura{
 
    // database connection and table name
    private $conn;
    private $table_name = "lecturas";
 
    // object properties
    public $numero_lectura;
    public $valor;
    public $fecha;
    public $hora;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
function read(){
 
    // select all query
    $query = "select * from lecturas";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


function create(){
 
    // query to insert record
    $query = "INSERT INTO lecturas SET valor=:valor, fecha=:fecha, hora=:hora";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
   
    $this->valor=htmlspecialchars(strip_tags($this->valor));
    $this->fecha=htmlspecialchars(strip_tags($this->fecha));
    $this->hora=htmlspecialchars(strip_tags($this->hora));
 
 
    // bind values
    
    $stmt->bindParam(":valor", $this->valor);
    $stmt->bindParam(":fecha", $this->fecha);
    $stmt->bindParam(":hora",$this->hora);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}
?>