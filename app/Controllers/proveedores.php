<?php 

include_once('../config.php');
include_once(DIRNAME.'/model/proveedores.php');
// Dependiendo de los casos de uso
if(isset($_POST['action'])) {
    $proy = new Proveedores();
    $action = $_POST['action'];
    $values = (isset($_POST['values'])) ? $_POST['values'] : null;

    //echo $values;
    switch ($action) {
        case 0: $proy->insert($data); break; //inserta y edita 
        case 1: $proy->changeStatus($values); break; //cambia el estado de un registro
        case 2: $proy->getregistrosespecifico($data); break; //Trae la informaciín del registro a Editar
        case 3: $proy->readAll($values); break; //trae todos los registros para la grilla         
        case 4: $proy->select_idclasificacion_ucc($data); break;  //crea una lista para otras vistas
        case 5: $proy->edit_clasificar($data); break;
        case 6: $proy->select_uucc($data); break;
        case 7: $proy->getNameUcgeneral($values); break;
        case 8: $proy->copiarCategoriaIndividual($data); break;
        case 9: $proy->selectCopiarCategoriaIndividual($values); break;
        default: # code... 
        break;
    }
}