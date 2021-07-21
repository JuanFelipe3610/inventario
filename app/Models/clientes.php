<?php 
    class Clientes extends Connection {
        public function __construct() {
            parent::__construct();
        } 
        
        public function readAll ($values) {
            $value = json_decode($values);
            $query = "SELECT * FROM  clientes WHERE estado = ".$value[0]->estado;
            $result = $this->conn->query($query);
            while($row = $result->fetch_array()) { 
                $data[] = array(
                    'ID'     => $row['id_cliente'],
                    'CODIGO' => $row['codigo_cliente'],
                    'NOMBRE' => $row['nombre'],
                    'NEGOCIO' => $row['negocio'],
                    'DIRECCION' => $row['direccion'],
                    'TELEFONO' => $row['telefono'],
                    'BARRIO' => $row['barrio'],
                    'NIT' => $row['nit'],
                    'VENDEDOR' => $row['id_vendedor']
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