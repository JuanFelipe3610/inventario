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
        $value = $this->post('values');
        return $this->FacturasModel->readAll($value);
    }
}