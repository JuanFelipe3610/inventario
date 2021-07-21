<?php 
require_once('../config.php');
require_once('../header.php');
?>
<h3 class="page-header"><i class="icon_wallet_alt"></i>Inventario</h3>
<div class="box-basic-button-flex">
  <button data-placement="top" data-toggle="modal" data-target="#addFactura" class="basic-button green-button tooltips" type="button" data-original-title="Añadir" id="crearFactura"><span class="fa fa-plus-circle"></span></button>
  <button data-placement="top" data-toggle="modal" data-target="#papelera" class="basic-button tooltips" type="button" data-original-title="Papelera"><span class="fa fa-trash-o"></span></button>
</div>
<div class="box-basic">
  <div class="box-header">
    <h3></h3>
    <button class="box-header-button fa fa-minus data-widget-collapse"></button>
  </div>
  <div class="box-swap">
    <table id="facturas" data-sort-order="asc" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="true" data-pagination="true" data-page-list=""></table>   
  </div>
</div>
<?php require_once('../footer.php'); ?>