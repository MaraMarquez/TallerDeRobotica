<?php
class temperatura{
    private $conn;
    private $table_name = "temperatura";

    public $id;
    public $valor;
    public $fecha;
    public $hora;

    public function __construct($db){
        $this->conn = $db;

    }

    function read(){
        $query = "select * from temperatura";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;

    }
}
?>