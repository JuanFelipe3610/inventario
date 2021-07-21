<?php 
require_once('../config.php');
require_once('../header.php');
?>
<h3 class="page-header"><i class="icon_menu-square_alt2"></i>Menus</h3>
<div class="box-basic-button-flex">
  <button data-placement="top" data-toggle="modal" data-target="#AddmenuModal" class="basic-button green-button tooltips" type="button" data-original-title="Añadir"><span class="fa fa-plus-circle"></span></button>
  <button data-placement="top" data-toggle="tooltip" class="basic-button tooltips" type="button" data-original-title="Papelera"><span class="fa fa-trash-o"></span></button>
</div>
<div class="box-basic">
  <div class="box-swap">
    <table id="table-datos" data-sort-name="nombre_tercero" data-sort-order="asc" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="true" data-pagination="true" data-page-list="" ></table> 
  </div>
</div>
<div id="data-container"></div>
<div id="pagination-demo1"></div>
<!-- Modal -->
<div class="modal fade" id="AddmenuModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Añadir Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="basic-button gray-button">Guardar Cambios</button>
        <button type="button" class="basic-button red-button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php require_once('../footer.php'); ?>