var DATA = [];
var URL = null;
var ACTION = null;

$(document).ready(function() {
    URL = URI() + "/controller/proveedores.php";
    ACTION = 3;
    ARRAY = [];
    ARRAY.push({
        estado: 1
    });
    VALUES = JSON.stringify(ARRAY);
    Ajax(URL, ACTION, VALUES, function(response) {
        //console.log(response);
        $("#table-datos").bootstrapTable({
            data: response,
            striped: true,
            pageSize: 20,
            paginationHAlign: false,
            filterControl: true,
            showExport: false,
            exportTypes: ["excel"],
            columns: [
                [{
                    field: "ID",
                    title: "No.",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    sortable: "true"
                }, {
                    field: "CODIGO",
                    title: "CÓDIGO",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "TIPO",
                    title: "TIPO",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "IDENTIFICACION",
                    title: "IDENTIFICACIÓN",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "RAZON_SOCIAL",
                    title: "RAZÓN SOCIAL",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "NOMBRE",
                    title: "NOMBRE",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    sortable: "true"
                }, {
                    field: "TELEFONOS",
                    title: "TÉLEFONO",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "DIRECCION",
                    title: "DIRECCIÓN",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "CIUDAD",
                    title: "CIUDAD",
                    align: "center",
                    valign: "middle",
                    rowspan: 2
                }, {
                    field: "EDITAR",
                    title: "EDITAR",
                    align: "center",
                    valign: "middle",
                    width: 100,
                    rowspan: 2,
                    formatter: function(value) {
                        return (
                            '<button class="basic-button orange-button tooltips" type="button"><span class="icon_pencil"></span></button>'
                        );
                    }
                }, {
                    field: "ELIMINAR",
                    title: "ELIMINAR",
                    align: "center",
                    valign: "middle",
                    width: 100,
                    rowspan: 2,
                    formatter: function(value) {
                        return (
                            '<button class="basic-button red-button tooltips" type="button"><span class="fa fa-times-circle"></span></button>'
                        );
                    }
                }],
                []
            ]
        });
    });
});