<?php 
    class Consecutivos extends Connection {
        public function __construct() {
            parent::__construct();
        } 
        
        public function readAll ($values) {
            $value = json_decode($values);
            $query = "SELECT
                id_producto,
                codigo_producto, nombre_producto, 
                SUM(cantidad) AS cantidad, 
                SUM(cantidad * precio) AS total,
                DAY(fecha) AS dia,
                Date_format(fecha, '%Y-%m-%d') AS fecha,
                precio
            FROM 
                factura_productos
            INNER JOIN productos USING (id_producto)
            INNER JOIN facturas USING (id_factura)
            GROUP BY 
                id_producto, 
                DAY(fecha), 
                precio, 
                Date_format(fecha, '%Y-%m-%d')
            ORDER BY Date_format(fecha, '%Y-%m-%d') DESC";
            $result = $this->conn->query($query);
            while($row = $result->fetch_array()) { 
                $data[] = array(
                    'ID'       => $row['id_producto'],
                    'CODIGO'   => $row['codigo_producto'],
                    'NOMBRE'   => $row['nombre_producto'],
                    'CANTIDAD' => $row['cantidad'],
                    'PRECIO'   => $row['precio'],
                    'TOTAL'    => $row['total'],
                    'DIA'      => $row['dia'],
                    'FECHA'    => $row['fecha']
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