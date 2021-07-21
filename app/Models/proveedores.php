<?php 
    /**
     * 
     */
    class Proveedores extends Connection 
    {
        public function __construct() 
        {
            parent::__construct();
        } 
        
        public function readAll ($values) 
        {
            $value = json_decode($values);
            $query = "SELECT 
				p.id_proveedor,
				p.codigo_proveedor,
				concat(ti.avreviatura, ': ', p.identificacion ) AS identificacion,
				tp.detalles AS tipo,
				p.razon_social,
				p.nombre,
				p.telefonos,
				p.direccion,
				m.nombre AS ciudad
				FROM  
				proveedores p, 
				tipo_proveedor tp, 
				tipo_identificacion ti, 
				municipios m 
				WHERE 
				p.id_tipo_identificacion = ti.id_tipo_identificacion AND
				p.id_tipo_proveedor = tp.id_tipo_proveedor AND
				p.id_municipios = m.id_municipios AND estado = ".$value[0]->estado;
            $result = $this->conn->query($query);

            while($row = $result->fetch_array()) 
            { 
                $data[] = array(
                    'ID'     => $row['id_proveedor'],
                    'CODIGO' => $row['codigo_proveedor'],
                    'IDENTIFICACION' => $row['identificacion'],
                    'TIPO' => $row['tipo'],
                    'RAZON_SOCIAL' => $row['razon_social'],
                    'NOMBRE' => $row['nombre'],
                    'TELEFONOS' => $row['telefonos'],
                    'DIRECCION' => $row['direccion'],
                    'CIUDAD' => $row['ciudad']
                );
            }
            
            if(isset($_GET["callback"]))
            {   
                echo $_GET["callback"]."(" . json_encode($data) . ");";  
            }
            else
            {
                echo  json_encode($retorno);
            }
        }

        public function getData ($values) 
        {
            $value = json_decode($values);
            $query = "SELECT * FROM  proveedores WHERE estado = ".$value[0]->estado;
            $result = $this->conn->query($query);

            while($row = $result->fetch_array()) 
            { 
                $data[] = array(
                    'ID'     => $row['id_proveedor'],
                    'CODIGO' => $row['codigo_proveedor'],
                    'ID_TIPO_IDENTIFICACION' => $row['id_tipo_identificacion'],
                    'IDENTIFICACION' => $row['identificacion'],
                    'ID_TIPO_PROVEEDOR' => $row['id_tipo_proveedor'],
                    'RAZON_SOCIAL' => $row['razon_social'],
                    'NOMBRE' => $row['nombre'],
                    'TELEFONOS' => $row['telefonos'],
                    'DIRECCION' => $row['direccion'],
                    'ID_MUNICIPIOS' => $row['id_municipios']
                );
            }
            
            if(isset($_GET["callback"]))
            {   
                echo $_GET["callback"]."(" . json_encode($data) . ");";  
            }
            else
            {
                echo  json_encode($retorno);
            }
        }
    }
?>