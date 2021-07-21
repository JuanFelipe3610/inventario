<?php 
class TempFactura extends Connection {
    public function __construct() {
        parent::__construct();
    } 

    public function readAll ($values) {
        $data = array();
        $value = json_decode($values);
        $query = "SELECT 
        tf.id_cliente,
        c.nombre,
        c.negocio,
        c.direccion,
        c.telefono,
        c.barrio,
        c.nit,
        concat(v.nombre, ' ', v.apellido) AS vendedor,
        tf.fecha
        FROM  
        temp_factura tf, 
        clientes c, 
        vendedor v
        WHERE 
        tf.id_temp_factura = 1 AND
        tf.id_cliente = c.id_cliente AND
        v.id_vendedor = c.id_vendedor";
        $result = $this->conn->query($query);

        $sql = "SELECT id_factura FROM facturas ORDER by id_factura DESC LIMIT 1";
        $res = $this->conn->query($sql);
        $id_factura = $res->fetch_array();
        if ($id_factura['id_factura'] == null) {
            $id = 1;
        }else{
            $id = $id_factura['id_factura']+1;
        }
        
        while($row = $result->fetch_array()) { 
            $date = date_create($row['fecha']);
            $data[] = array(
                'ID'     => $row['id_cliente'],
                'NOMBRE' => $row['nombre'],
                'NEGOCIO' => $row['negocio'],
                'DIRECCION' => $row['direccion'],
                'TELEFONO' => $row['telefono'],
                'BARRIO' => $row['barrio'],
                'NIT' => $row['nit'],
                'VENDEDOR' => $row['vendedor'],
                'FECHA' => date_format($date, "Y/m/d"),
                'ID_FACTURA' => $id
            );
        }

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($retorno);
        }
    }

    public function listProductsFact ($values) {
        $data = array();
        $value = json_decode($values);
        $query = "SELECT 
        id_temp_factura,
        codigo_producto,
        nombre_producto,
        cantidad,
        precio,
        id_temp_factura_productos
        FROM  
        temp_factura_productos tfp, 
        productos p 
        WHERE 
        id_temp_factura = 1 AND 
        tfp.id_producto = p.id_producto";
        $result = $this->conn->query($query);
        while($row = $result->fetch_array()) { 
            $data[] = array(
                'ID'     => $row['id_temp_factura'],
                'IDPRODUCTS' => $row['id_temp_factura_productos'],
                'CODIGO' => $row['codigo_producto'],
                'NOMBRE' => $row['nombre_producto'],
                'CANTIDAD' => $row['cantidad'],
                'PRECIO' => $row['precio'],
                'TOTAL' => ($row['precio'] * $row['cantidad'])
            );
        }

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($retorno);
        } 
    }

    public function  addClient ($values) {
        $data = array();
        $values = json_decode($values);
        $value = $values[0];
        $query = "UPDATE fic.temp_factura SET fecha = '$value->fecha', id_cliente = $value->id_cliente WHERE  id_temp_factura = 1;";
        $result = $this->conn->query($query);

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($retorno);
        } 
    }

    public function  deleteProduct ($values) {
        $data = array();
        $values = json_decode($values);
        $value = $values[0];
        $query = "DELETE FROM temp_factura_productos WHERE id_temp_factura_productos = $value->id_temp_factura_productos";
        $result = $this->conn->query($query);

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($retorno);
        } 
    }

    public function  addProduct ($values) {
        $data = array();
        $values = json_decode($values);
        $value = $values[0];
        $query = "SELECT COUNT(*) FROM temp_factura_productos WHERE id_producto = $value->id_producto";
        $consult = $this->conn->query($query);
        $row = mysqli_fetch_row($consult);
        if ($row[0] != 0){
            $data = array(
                'ERROR'   => "1",
                'MESSAGE' => "El producto ya esta ingresado.",
            );
        }else{
            $query = "SELECT precio FROM lista_precios WHERE id_producto = '$value->id_producto'";
            $consult = $this->conn->query($query);
            $row = mysqli_fetch_row($consult);
            $query = "INSERT INTO temp_factura_productos (id_temp_factura, id_producto, cantidad, precio) VALUES ('1', '$value->id_producto', '$value->cantidad', '$row[0]');";
            $result = $this->conn->query($query);
            $data = array(
                'ERROR'   => "0",
                'MESSAGE' => "Añadido",
            );
        }

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($retorno);
        } 
    }

    public function  updateCantidad ($values) {
        $data = array();
        $values = json_decode($values);
        $value = $values[0];
        $query = "UPDATE fic.temp_factura_productos SET cantidad = '$value->cantidad' WHERE  id_temp_factura_productos = '$value->id_temp_factura_productos'";
        $result = $this->conn->query($query);

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($data);
        } 
    }

    public function  updatePrice ($values) {
        $data = array();
        $values = json_decode($values);
        $value = $values[0];
        $query = "UPDATE fic.temp_factura_productos SET precio = '$value->precio' WHERE  id_temp_factura_productos = '$value->id_temp_factura_productos'";
        $this->conn->query($query);

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($data);
        } 
    }

    public function saveFactura ($values) {
        $data = array();
        $values = json_decode($values);
        $value = $values[0];
        $query2 = "SELECT * FROM temp_factura_productos WHERE id_temp_factura = 1";
        $result2 = $this->conn->query($query2);
        $row = $result2->fetch_array();
        if ($row['id_temp_factura'] != null) {
            $query = "SELECT * FROM temp_factura WHERE id_temp_factura = 1";
            $result = $this->conn->query($query);
            $row = $result->fetch_array();

            $sql = "SELECT id_factura FROM facturas ORDER BY id_factura DESC LIMIT 1";
            $res = $this->conn->query($sql);
            $id_factura = $res->fetch_array();
            if ($id_factura['id_factura'] == null) {
                $id = 1;
            }else{
                $id = $id_factura['id_factura']+1;
            }

            $sql = "INSERT INTO facturas (id_factura, id_cliente, fecha, estado) VALUES ($id, '".$row['id_cliente']."', '".$row['fecha']."', '1')";
            $this->conn->query($sql);

            $query2 = "SELECT * FROM temp_factura_productos WHERE id_temp_factura = 1";
            $result2 = $this->conn->query($query2);
            while ($row2 = $result2->fetch_array()) {
                $sql2 = "INSERT INTO factura_productos 
                    (id_factura, id_producto, cantidad, precio) 
                VALUES 
                ($id, '".$row2['id_producto']."', '".$row2['cantidad']."', '".$row2['precio']."')";
                $this->conn->query($sql2);
            }
            
            $query = "DELETE FROM temp_factura_productos";
            $this->conn->query($query);
            $query = "UPDATE temp_factura SET id_cliente = null, fecha = null WHERE  id_temp_factura = '1'";
            $this->conn->query($query);
        } 

        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($data);
        } 
    }
}
?>