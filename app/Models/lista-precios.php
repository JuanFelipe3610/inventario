<?php 
    class ListaPrecios extends Connection {
        public function __construct() {
            parent::__construct();
        } 
        
        public function readAll ($values) {
            $data = array();
            $value = json_decode($values);
            $query = "SELECT 
                ls.id_lista_precio, 
                p.codigo_producto, 
                p.nombre_producto, 
                ls.precio, 
                ls.estado 
            FROM 
                lista_precios ls, 
                productos p 
            WHERE 
                ls.estado = ".$value[0]->estado." AND 
                p.estado = ".$value[0]->estado." AND 
                ls.id_producto = p.id_producto";
            $result = $this->conn->query($query);
            while($row = $result->fetch()) { 
                $data[] = array(
                    'ID'       => $row['id_lista_precio'],
                    'CODIGO'   => $row['codigo_producto'],
                    'NOMBRE'   => $row['nombre_producto'],
                    'PRECIO'   => $row['precio'],
                    'ESTADO'   => $row['estado'],
                    'EDITAR'   => $row['id_lista_precio'],
                    'ELIMINAR' => $row['id_lista_precio']
                );
            }
            
            if(isset($_GET["callback"])){   
                echo $_GET["callback"]."(" . json_encode($data) . ");";  
            }else{
                echo  json_encode($retorno);
            }
        }

        public function listFact ($values) {
            $data = array();
            $value = json_decode($values);
            $query = "SELECT 
                ls.id_lista_precio, 
                p.codigo_producto, 
                p.nombre_producto, 
                ls.precio, 
                ls.estado 
            FROM 
                lista_precios ls, 
                productos p
            WHERE 
                ls.estado = ".$value[0]->estado." AND 
                p.estado = ".$value[0]->estado." AND 
                ls.id_producto = p.id_producto AND 
                ls.id_producto NOT IN (SELECT tfp.id_producto FROM temp_factura_productos tfp)";
            $result = $this->conn->query($query);
            while($row = $result->fetch()) { 
                $data[] = array(
                    'ID'       => $row['id_lista_precio'],
                    'CODIGO'   => $row['codigo_producto'],
                    'NOMBRE'   => $row['nombre_producto'],
                    'PRECIO'   => $row['precio'],
                    'ESTADO'   => $row['estado'],
                    'EDITAR'   => $row['id_lista_precio'],
                    'ELIMINAR' => $row['id_lista_precio']
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