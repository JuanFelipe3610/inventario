<?php 
    class Productos extends Connection {
        public function __construct() {
            parent::__construct();
        } 
        
        public function readAll ($values) {
            $value = json_decode($values);
            $query = "SELECT * FROM  productos WHERE estado = ".$value[0]->estado;
            $result = $this->conn->query($query);
            while($row = $result->fetch_array()) { 
                $data[] = array(
                    'ID'     => $row['id_producto'],
                    'CODIGO' => $row['codigo_producto'],
                    'NOMBRE' => $row['nombre_producto'],
                    'EDITAR' => $row['id_producto'],
                    'ELIMINAR' => $row['id_producto']
                );
            }
            
            if(isset($_GET["callback"])){   
                echo $_GET["callback"]."(" . json_encode($data) . ");";  
            }else{
                echo  json_encode($retorno);
            }
        }
    }
?>