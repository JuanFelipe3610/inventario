var DATA = [];
var URL = null;
var ACTION = null;

$(document).ready(function() {
    URL = URI() + "/controller/menuTable.php";
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
            groupBy: true,
            groupByField: "POSITION",
            groupByFormatter: function(value) {
                val = ""
                switch (value) {
                    case '1':
                        val = 'Top'
                        break;
                    case '2':
                        val = 'Left'
                        break;
                    case '3':
                        val = 'Right'
                        break;
                }
                return "<i style='border-left: 2px solid #1E88E5; padding-left: 8px;'> " + val + "</i>";
            },
            columns: [
                [{
                    field: "ID",
                    title: "No.",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    sortable: "true"
                }, {
                    field: "NOMBRE",
                    title: "NOMBRE",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    filterControl: "INPUT",
                    sortable: "true"
                }, {
                    field: "URL",
                    title: "URL",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    filterControl: "INPUT",
                    sortable: "true"
                }, {
                    field: "ICON",
                    title: "ICON",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    formatter: function(value) {
                        return (
                            '<div class="' + value + '"></div>'
                        );
                    }
                }, {
                    field: "POSITION",
                    title: "POSICIÓN",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    filterControl: "INPUT",
                    sortable: "true"
                }, {
                    field: "ORDEN",
                    title: "ORDEN",
                    align: "center",
                    valign: "middle",
                    rowspan: 2,
                    filterControl: "INPUT",
                    sortable: "true"
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
        /*response.forEach(element => {
            DATA.push("<tr><td>"+element.ID+"</td>"+"<td>"+element.CODIGO+"</td>"+"<td>"+element.NOMBRE+"</td></tr>")
        });
        console.log(DATA);*/
    });
});