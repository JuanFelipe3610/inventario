<?php

namespace App\Controllers;
use App\Models\FacturasModel;

class FacturasController extends PagesController
{
    private $FacturasModel;

	public function __construct(){
        parent::__construct();
        $this->FacturasModel = new FacturasModel();
    }

    public function index($page = 'facturas')
	{ 
        $this->view($page);
	}

    public function listFacturas()
    {
        $data = [];
        $estado = $this->post('estado');
        if (!isset($estado) || empty($estado)) {
            $estado = null;
        }
        $r = $this->FacturasModel->readAll($estado);
        foreach($r as $row) { 
            $date = date_create($row->created);
            $data[] = array(
                'VER'       => '<span class="basic-button">Ver</span>',
                'ID'        => $row->id_factura,
                'CODIGO'    => $row->codigo_cliente,
                'NOMBRE'    => $row->nombre,
                'NEGOCIO'   => $row->negocio,
                'VENDEDOR'  => $row->vendedor,
                'DIRECCION' => $row->direccion,
                'BARRIO'    => $row->barrio,
                'FECHA'     => date_format($date, "Y/m/d"),
                'ACCTION'   => $row->id_factura
            );
        }
        echo json_encode($data);
    }

    public function changeEstado()
    {
        $value = $this->post('values');
        if (!is_null($value)) {
            $value = json_decode($value);
            $value = $value[0]->estado;
        }else{
            $value = null;
        }
        return $this->FacturasModel->readAll($value);
    }

    public function delete(){
        $id = $this->post('id');
        echo json_encode($this->FacturasModel->deleteFactura($id));
    }

}