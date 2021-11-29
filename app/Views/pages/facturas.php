<h3 class="page-header"><i class="fa fa-file-text-o"></i>Facturas</h3>
<div class="box-basic-button-flex">
  <button data-placement="top" data-toggle="modal" <?php //data-target="#addFactura" ?> class="basic-button green-button tooltips" type="button" data-original-title="Añadir" id="crearFactura"><span class="fa fa-plus-circle"></span></button>
  <button data-placement="top" data-toggle="modal" data-target="#papelera" class="basic-button tooltips" type="button" data-original-title="Papelera" id="facturasEliminadas"><span class="fa fa-trash-o"></span></button>
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
<!-- Modal Añadir -->
<div class="modal fade" id="addFactura" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-large" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body factura">
        <div class="factuHeader">
          <div class="box-flex space-between">
            <div>
              <h2>Detalles del cliente :</h2>
              <p>CLIENTE:&nbsp;&nbsp;&nbsp;
                <span id="nombre_cliente"></span>&nbsp;&nbsp;&nbsp;
                <button data-placement="top" data-toggle="modal" data-target="#addCliente" class="tooltips" data-original-title="Seleccionar cliente" id="seleccionarCliente">
                  <span class="fa fa-pencil"></span>
                </button>
              </p>
              <p>NEGOCIO:&nbsp;&nbsp;&nbsp;<span id="negocio"></span></p>
              <p>DIRECCION:&nbsp;&nbsp;&nbsp;<span id="direccion"></span></p>
              <p>TELEFONO:&nbsp;&nbsp;&nbsp;<span id="telefono"></span></p>
              <p>BARRIO:&nbsp;&nbsp;&nbsp;<span id="barrio"></span></p>                
              <p>VENDEDOR:&nbsp;&nbsp;&nbsp;<span id="vendedor"></span></p>
            </div>
            <div>
              <h2>Detalles de la factura :</h2>
              <p>FACTURA Nº:&nbsp;&nbsp;&nbsp;<span id="No_factura"></span></p>
              <p>FECHA:&nbsp;&nbsp;&nbsp;<span id="fecha_factura"></span></p>
            </div>
          </div>
        </div>
        <table id="list-products-factura" data-sort-order="asc">
          <thead>
            <tr>
              <th style="text-align: center;vertical-align: middle;">CODIGO</th>
              <th style="text-align: left;vertical-align: middle;">NOMBRE</th>
              <th style="text-align: center;vertical-align: middle;">CANTIDAD</th>
              <th style="text-align: center;vertical-align: middle;">PRECIO UNIT.</th>
              <th style="text-align: center;vertical-align: middle;">PRECIO TOTAL</th>
              <th style="text-align: center;vertical-align: middle;"></th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <td style="text-align: center;vertical-align: middle;"><button data-toggle="modal" data-target="#ListProduct" class="basic-button" id="listproductos"><span class="fa fa-plus"></span>&nbsp;&nbsp;&nbsp;Añadir ítem</button></td>
              <td></td>
              <td></td>
              <td style="text-align: center;vertical-align: middle;font-weight: bold;font-style: italic;">TOTAL:</td>
              <td id="list-products-factura-Total"></td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="basic-button green-button" id="saveFactura">Guardar</button>
        <button type="button" class="basic-button red-button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Clientes -->
<div class="modal fade backdrop" id="addCliente" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-mid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="clientes" data-sort-order="asc" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="true" data-pagination="false" data-page-list="" ></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="basic-button red-button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Productos -->
<div class="modal fade backdrop" id="ListProduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-mid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table-striped" id="list-products" data-sort-order="asc" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="true" data-pagination="true" data-page-list="" ></table>          
      </div>
      <div class="modal-footer">
        <button type="button" class="basic-button red-button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Papelera -->
<div class="modal fade backdrop" id="papelera" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-mid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Facturas Eliminadas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="FacturasEliminadas" data-sort-order="asc" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="true" data-pagination="true" data-page-list=""></table>          
      </div>
      <div class="modal-footer">
        <button type="button" class="basic-button red-button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<iframe src="" frameborder="0" id="pdf" style="display:none;"></iframe>