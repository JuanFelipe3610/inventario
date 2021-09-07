<?php

namespace App\Controllers;
use App\Models\FacturasModel;

class FacturasController extends BaseController
{
    private $PagesController;
    private $FacturasModel;

	public function __construct(){
        $this->PagesController = new PagesController();
        $this->FacturasModel = new FacturasModel();
    }

    public function index($page = 'facturas')
	{ 
        $this->PagesController->view($page);
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

}