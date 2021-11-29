<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturasModel extends Model
{

    protected $table      = 'facturas';
    protected $primaryKey = 'id_factura';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_cliente', 'deleted'];

    protected $useTimestamps = true;
    protected $createdField  = 'created';
    protected $updatedField  = 'updated';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function readAll($estado)
    {
        $query = "SELECT 
            f.id_factura,
            c.codigo_cliente,
            c.nombre,
            c.negocio,
            concat(v.nombre, ' ', v.apellido) AS vendedor,
            f.created,
            c.barrio,
            c.direccion,
            c.telefono
            FROM  
            facturas f, 
            clientes c, 
            vendedor v
            WHERE 
            f.id_cliente = c.id_cliente AND
            v.id_vendedor = c.id_vendedor AND
            f.deleted IS NULL
            ORDER BY f.created DESC";
        $result = $this->query($query);
        return $result->getResult();
    }

    public function listProductsFact($values)
    {
        $data = array();
        $value = json_decode($values);
        $query = "SELECT 
        id_factura,
        codigo_producto,
        nombre_producto,
        cantidad,
        precio,
        id_factura_productos
        FROM  
        factura_productos fp, 
        productos p 
        WHERE 
        id_factura = $value->id AND 
        fp.id_producto = p.id_producto";
        $result = $this->conn->query($query);
        while ($row = $result->fetch()) {
            $data[] = array(
                'ID'            => $row['id_factura'],
                'IDPRODUCTS'    => $row['id_factura_productos'],
                'CODIGO'        => $row['codigo_producto'],
                'NOMBRE'        => $row['nombre_producto'],
                'CANTIDAD'      => $row['cantidad'],
                'PRECIO'        => $row['precio'],
                'TOTAL'         => ($row['precio'] * $row['cantidad'])
            );
        }

        if (isset($_GET["callback"])) {
            echo $_GET["callback"] . "(" . json_encode($data) . ");";
        } else {
            return json_encode($data);
        }
    }

    public function getFactura($values)
    {
        $data = array();
        $value = json_decode($values);
        $query = "SELECT 
        f.id_factura,
        c.codigo_cliente,
        c.nombre,
        c.negocio,
        concat(v.nombre, ' ', v.apellido) AS vendedor,
        f.fecha,
        c.barrio,
        c.direccion,
        c.telefono
        FROM  
        facturas f, 
        clientes c, 
        vendedor v
        WHERE 
        f.id_cliente = c.id_cliente AND
        v.id_vendedor = c.id_vendedor AND
        f.id_factura = $value->id";
        $result = $this->conn->query($query);
        while ($row = $result->fetch()) {
            //$date = date_create($row['fecha']);
            $data[] = array(
                'ID'        => $row['id_factura'],
                'CODIGO'    => $row['codigo_cliente'],
                'NOMBRE'    => $row['nombre'],
                'NEGOCIO'   => $row['negocio'],
                'VENDEDOR'  => $row['vendedor'],
                'DIRECCION' => $row['direccion'],
                'BARRIO'    => $row['barrio'],
                'TELEFONO'  => $row['telefono'],
                'FECHA'     => $row['fecha'],
                'ACCTION'   => $row['id_factura']
            );
        }

        if (isset($_GET["callback"])) {
            echo $_GET["callback"] . "(" . json_encode($data) . ");";
        } else {
            return json_encode($data);
        }
    }

    public function changeEstado($values)
    {
        $value = json_decode($values);
        $value = $value[0];
        $query = "UPDATE facturas SET estado = $value->estado WHERE  id_factura = $value->id";
        $this->conn->query($query);
        if (isset($_GET["callback"])) {
            echo $_GET["callback"] . "(" . json_encode('cambiado') . ");";
        }
    }

    public function deleteFactura($id = null, bool $purge = false)
    {
        return $this->delete(['id' => $id]);
    }
}
