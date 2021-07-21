<?php
include_once('../config.php');
include_once(DIRNAME.'/model/productos.php');
// Dependiendo de los casos de uso
if(isset($_POST['action'])) {

    $proy = new Productos();
     
    /*$data = (Object) [                
        'nombre'  => (isset($_POST['nombre'])) ? $_POST['nombre'] : null,
        'codigo'=> (isset($_POST['codigo'])) ? $_POST['codigo'] : null,
        'old_cod'=> (isset($_POST['old_cod'])) ? $_POST['old_cod'] : null,
        'und_medida'=> (isset($_POST['und_medida'])) ? $_POST['und_medida'] : null,
        'FAER' => (isset($_POST['FAER'])) ? $_POST['FAER'] : null,
        'PRONE'=> (isset($_POST['PRONE'])) ? $_POST['PRONE'] : null,
        'ER'=> (isset($_POST['ER'])) ? $_POST['ER'] : null,
        'AR'=> (isset($_POST['AR'])) ? $_POST['AR'] : null,
        'PR'=> (isset($_POST['PR'])) ? $_POST['PR'] : null,
        'OC'=> (isset($_POST['OC'])) ? $_POST['OC'] : null,
        'EM'=> (isset($_POST['EM'])) ? $_POST['EM'] : null,
        'catalogo'=> (isset($_POST['catalogo'])) ? $_POST['catalogo'] : null,
        'UUCC1'=> (isset($_POST['UUCC1'])) ? $_POST['UUCC1'] : null,
        'UUCC2'=> (isset($_POST['UUCC2'])) ? $_POST['UUCC2'] : null,
        //Data obtiene los datos a insertar y Editar el ID y evento son fijos, el resto varía de de acuerdo a la tabla
        'id'                => (isset($_POST['id'])) ? $_POST['id'] : null,
        'evento'            => (isset($_POST['evento'])) ? $_POST['evento'] : null,
    ];*/  

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