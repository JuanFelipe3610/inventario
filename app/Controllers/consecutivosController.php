<?php
include_once('../config.php');
include_once(DIRNAME.'/model/consecutivos.php');
// Dependiendo de los casos de uso
if(isset($_POST['action'])) {

    $proy = new Consecutivos();
    $action = $_POST['action'];
    $values = (isset($_POST['values'])) ? $_POST['values'] : null;

    //echo $values;
    switch ($action) {
        case 0: $proy->addClient($values); break;
        case 1: $proy->deleteProduct($values); break; 
        case 2: $proy->addProduct($values); break;
        case 3: $proy->readAll($values); break;        
        case 4: $proy->listProductsFact($values); break;
        case 5: $proy->updateCantidad($values); break;
        case 6: $proy->updatePrice($values); break;
        default: # code... 
        break;
    }
}