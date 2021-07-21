var DATA = [];
var URL = null;
var ACTION = null;
class Buttons{
    constructor(fristButton = Object, buttons = Array){
        this.fristButton = fristButton
        this.buttons = buttons
    }

    get getButons(){
        let elment = this.createButtons()
        return elment.outerHTML
    }

    createNode(node, attributes){
        const el = document.createElement(node);
        for(let key in attributes){
            el.setAttribute(key, attributes[key]);
        }
        return el;
    }

    createIcon(icon){
        const i = document.createElement('i')
        i.setAttribute('class', icon)
        return i
    }

    createButtons(){
        // Elementos a crear
        let mainCont = this.createNode('div', {'class': 'acctions-buttons'})
        let fristCont = this.createNode('div', {'class': 'frist-buttons'})
        let secondCont = this.createNode('div', {'class': 'second-buttons'})
        let fristButton = this.createNode('button', {
            'class': this.fristButton.class, 
            'id': this.fristButton.id, 
            'data-id': this.fristButton.dataId
        })
        let secondButton = this.createNode('button', {'class': 'fa fa-caret-down btn-collapse' })
        
        // Se llenan los datos 
        for(let key in this.buttons){
            let button = this.createNode('button', {
                'class': this.buttons[key].class, 
                'id': this.buttons[key].id, 
                'data-id': this.buttons[key].dataId
            })
            button.append(this.createIcon(this.buttons[key].icon), this.buttons[key].text)
            secondCont.append(button)
        }
        fristButton.append(this.createIcon(this.fristButton.icon), this.fristButton.text)


        // Se organizan los elementos
        mainCont.append(fristCont, secondCont)
        fristCont.append(fristButton, secondButton)
        
        return mainCont
    }
}

$(document).ready(function () {
    printPdf = function (url) {
        var iframe = this._printIframe;
        if (!this._printIframe) {
            iframe = this._printIframe = document.createElement('iframe');
            document.body.appendChild(iframe);
            iframe.style.display = 'none';
            iframe.onload = function () {
                setTimeout(function () {
                    iframe.focus();
                    iframe.contentWindow.print();
                }, 1);
            };
        }
        iframe.src = url;
    }

    function listProductsFact() {
        URL = URI() + "/controller/temp-factura.php";
        ACTION = 4;
        ARRAY = [];
        ARRAY.push({
            id_temp_factura: 1
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            var total = 0;
            dataproduct = "";
            if (response[0] == null) {
                dataproduct = '<tr><td colspan="6" style="text-align: center;vertical-align: middle;">No se encontraron registros coincidentes</td></tr>'
            }
            response.forEach(element => {
                total += parseInt(element.TOTAL)
                dataproduct += '<tr>'
                dataproduct += '<td style="text-align:center;vertical-align:middle;">' + element.CODIGO + '</td>'
                dataproduct += '<td style="text-align:left;vertical-align:middle;">' + element.NOMBRE + '</td>'
                dataproduct += '<td style="width:150px;padding:0;"><input style="height:36px;text-align:center;" type="text" data-id="' + element.IDPRODUCTS + '" value="' + number_format(element.CANTIDAD) + '" class="form-control-transparent input-number cantidad"></td>'
                dataproduct += '<td style="width:150px;padding:0;"><input style="height:36px;text-align:center;" type="text" data-id="' + element.IDPRODUCTS + '" value="$' + number_format(element.PRECIO) + '" class="form-control-transparent input-number precio"></td>'
                dataproduct += '<td style="text-align:center;vertical-align:middle;width:150px;">' + '$' + number_format(element.TOTAL) + '</td>'
                dataproduct += '<td style="text-align:center;vertical-align:middle;width:40px;"><a style="cursor:pointer;color:#f55050;" data-id="' + element.IDPRODUCTS + '" class="icon_trash_alt" type="button" id="eliminarProducto"></a></td>'
                dataproduct += '</tr>'
            });
            $('#list-products-factura tbody').html(dataproduct)
            $('#list-products-factura-Total').html('$' + number_format(total));
        });
    }

    function dataClient() {
        URL = URI() + "/controller/temp-factura.php";
        ACTION = 3;
        Ajax(URL, ACTION, null, function (response) {
            tempfacdata = response[0];
            if (tempfacdata != null) {
                $('#nombre_cliente').html(tempfacdata.NOMBRE)
                $('#fecha_factura').html(tempfacdata.FECHA)
                $('#negocio').html(tempfacdata.NEGOCIO)
                $('#barrio').html(tempfacdata.BARRIO)
                $('#direccion').html(tempfacdata.DIRECCION)
                $('#vendedor').html(tempfacdata.VENDEDOR)
                $('#telefono').html(tempfacdata.TELEFONO)
                $('#No_factura').html(tempfacdata.ID_FACTURA)
            } else {
                $('#nombre_cliente').html('')
                $('#fecha_factura').html('')
                $('#negocio').html('')
                $('#barrio').html('')
                $('#direccion').html('')
                $('#vendedor').html('')
                $('#telefono').html('')
                $('#No_factura').html('')
            }
        });
    }

    function facturas() {
        URL = URI() + "/controller/facturas.php";
        ACTION = 3;
        ARRAY = [];
        ARRAY.push({
            estado: 1
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            $("#facturas").bootstrapTable({
                data: response,
                striped: true,
                pageSize: 20,
                paginationHAlign: true,
                filterControl: true,
                showExport: false,
                exportTypes: ["excel"],
                columns: [
                    [{
                        field: "ID",
                        title: "No. Factura",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "CODIGO",
                        title: "CODIGO",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true,
                        visible: true
                    }, {
                        field: "NOMBRE",
                        title: "CLIENTE",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "VENDEDOR",
                        title: "VENDEDOR",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "FECHA",
                        title: "FECHA",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "ACCTION",
                        title: "ACCIONES",
                        align: "center",
                        valign: "middle",
                        //width: 380,
                        rowspan: 2,
                        formatter: function (value) {
                            let fristButton = {icon: 'icon_pencil', class: 'orange-button', text: 'Editar', id: '', dataId: value}
                            let buttons = [
                                {icon: 'icon_printer', class: '', text: 'Imprimir', id: 'print', dataId: value},
                                {icon: 'fa fa-file-pdf-o', class: 'red-button', text: 'PDF', id: 'guardarPDF', dataId: value},
                                {icon: 'fa fa-file-excel-o', class: 'green-button', text: 'Ecxel', id: '', dataId: value},
                                {icon: 'fa fa-times-circle', class: 'red-button', text: 'Eliminar', id: 'delete', dataId: value}
                            ]
                            let actions = new Buttons(fristButton, buttons)
                            return actions.getButons
                        }
                    }],
                    []
                ]
            });
            $("#facturas").bootstrapTable("load", response);
        });
        $('.tooltips').tooltip();
    }

    $(document).on('mousedown', function(e) {
        //console.log(e.which)
        switch (e.which) {
            case 0:
                rightClick(e)
                break;
            case 1:
                $('#contexmenu').slideUp(100)
                break;
            case 2:
                $('#contexmenu').slideUp(100)
                break;
            case 3:
                rightClick(e)
                break;
            default:
                //alert('You have a strange Mouse!');
        }
    })
    
    function rightClick(element) {
        e = element.target
        //console.log(element)
        if (e.localName == 'td') {
            if (!document.getElementById('contexmenu')) {
                let content = document.createElement('ul')
                let options = [
                    {
                        nombre: 'Copiar texto',
                        icon: 'fa fa-copy',
                        dataId: 'copy'
                    },
                    {
                        nombre: 'Ver factura',
                        icon: 'fa fa-eye',
                        dataId: 'view'
                    }
                ]

                for(let key in options){
                    let option = document.createElement('li')
                    let i = document.createElement('i')
                    i.setAttribute('class', options[key].icon)
                    option.append(i)
                    option.append(document.createTextNode(options[key].nombre))
                    option.setAttribute('data-id', options[key].dataId)
                    content.setAttribute('id', 'contexmenu')
                    content.append(option)
                }
                $('body').append(content)
            }
            $('#contexmenu').fadeOut(100,function(){
                $('#contexmenu').css({
                    'top': element.clientY,
                    'left': element.clientX 
                })
            })
            
            $('#contexmenu').slideDown(100)         
        }else{
            $('#contexmenu').slideUp(100)
        }
    }

    facturas();

    $(document).on('click', '#crearFactura', function () {
        listProductsFact();
        dataClient();
    });

    $(document).on('click', '#listproductos', function () {
        URL = URI() + "/controller/lista-precios.php";
        ACTION = 1;
        ARRAY = [];
        ARRAY.push({
            estado: 1
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            $("#list-products").bootstrapTable({
                data: response,
                striped: true,
                pageSize: 4,
                paginationHAlign: true,
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
                        sortable: true
                    }, {
                        field: "CODIGO",
                        title: "CODIGO",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true,
                        visible: true
                    }, {
                        field: "NOMBRE",
                        title: "NOMBRE",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "PRECIO",
                        title: "VALOR/UND",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true,
                        width: 30,
                        formatter: function (value) {
                            return (
                                '<div class="box-flex aling-items-center"><span>$</span><input type="text" value="' + value + '" class="form-control-transparent input-number"></div>'
                            );
                        }
                    }, {
                        field: "ELIMINAR",
                        title: "CANTIDAD",
                        align: "center",
                        valign: "middle",
                        width: 40,
                        rowspan: 2,
                        formatter: function (value) {
                            return (
                                '<input type="text" id="cantidadProduct' + value + '" class="form-control input-number">'
                            );
                        }
                    }, {
                        field: "EDITAR",
                        title: "AÑADIR",
                        align: "center",
                        valign: "middle",
                        width: 100,
                        rowspan: 2,
                        formatter: function (value) {
                            return (
                                '<button data-id="' + value + '" class="basic-button green-button tooltips" type="button" id="addProduct"><span class="fa fa-plus-circle"></span></button>'
                            );
                        }
                    }],
                    []
                ]
            });
            $("#list-products").bootstrapTable("load", response);
        });
    });

    $('#seleccionarCliente').on('click', function () {
        URL = URI() + "/controller/clientes.php";
        ACTION = 3;
        ARRAY = [];
        ARRAY.push({
            estado: 1
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            $("#clientes").bootstrapTable({
                data: response,
                striped: true,
                pageSize: 10,
                paginationHAlign: true,
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
                        sortable: true,
                        visible: false
                    }, {
                        field: "CODIGO",
                        title: "CODIGO",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true,
                        visible: true
                    }, {
                        field: "NOMBRE",
                        title: "NOMBRE",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "NEGOCIO",
                        title: "NEGOCIO",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "BARRIO",
                        title: "BARRIO",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "ID",
                        title: "SELECCIONAR",
                        align: "center",
                        valign: "middle",
                        width: 100,
                        rowspan: 2,
                        formatter: function (value) {
                            return (
                                '<button data-id="' + value + '" class="basic-button green-button tooltips" type="button" id="selecClient"><span class="fa fa-check"></span></button>'
                            );
                        }
                    }],
                    []
                ]
            });
        });
    });

    $(document).on('click', '#selecClient', function () {
        data = $(this).attr('data-id');
        date = dataTime();
        URL = URI() + "/controller/temp-factura.php";
        ACTION = 0;
        ARRAY = [];
        ARRAY.push({
            id_cliente: data,
            fecha: date
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            dataClient();
        });
        $("#addCliente").modal("hide");
    });

    $(document).on('click', '#eliminarProducto', function () {
        data = $(this).attr('data-id');
        URL = URI() + "/controller/temp-factura.php";
        ACTION = 1;
        ARRAY = [];
        ARRAY.push({
            id_temp_factura_productos: data
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            listProductsFact();
        });
    });

    $(document).on('click', '#addProduct', function () {
        data = $(this).attr('data-id');
        cantidad = $('#cantidadProduct' + data).val();
        if (cantidad == "") {
            $('#cantidadProduct' + data).css('border-color', 'red');
        } else {
            $('#cantidadProduct' + data).css('border-color', '');
            URL = URI() + "/controller/temp-factura.php";
            ACTION = 2;
            ARRAY = [];
            ARRAY.push({
                id_producto: data,
                cantidad: cantidad
            });
            VALUES = JSON.stringify(ARRAY);
            Ajax(URL, ACTION, VALUES, function (response) {
                listProductsFact();
                $('#cantidadProduct' + data).val("");
            });

            URL = URI() + "/controller/lista-precios.php";
            ACTION = 1;
            ARRAY = [];
            ARRAY.push({
                estado: 1
            });
            VALUES = JSON.stringify(ARRAY);
            Ajax(URL, ACTION, VALUES, function (response) {
                $("#list-products").bootstrapTable("load", response);
            });
        }
    });

    $(document).on("change", ".cantidad", function () {
        let cantidad = $(this).val();
        cantidad = cantidad.replace(/,/g, '')
        if (cantidad == "" || cantidad < 1) {
            swal("ERROR", "la cantidad no puede ser menor que uno", "error");
        } else {
            if (cantidad > 999999999) {
                swal("ERROR", "la cantidad no puede ser mayor que 999,999,999", "error");
            } else {
                URL = URI() + "/controller/temp-factura.php";
                ACTION = 5;
                ARRAY = [];
                ARRAY.push({
                    id_temp_factura_productos: $(this).attr("data-id"),
                    cantidad: cantidad
                });
                VALUES = JSON.stringify(ARRAY);
                Ajax(URL, ACTION, VALUES, function () {
                    listProductsFact();
                });
            }
        }
    });

    $(document).on("change", ".precio", function () {
        let precio = $(this).val();
        precio = precio.replace(/,/g, '')
        precio = precio.replace('$', '')
        if (precio == "" || precio < 1) {
            swal("ERROR", "la precio no puede ser menor que uno", "error");
        } else {
            if (precio > 999999999) {
                swal("ERROR", "la precio no puede ser mayor que 999,999,999", "error");
            } else {
                URL = URI() + "/controller/temp-factura.php";
                ACTION = 6;
                ARRAY = [];
                ARRAY.push({
                    id_temp_factura_productos: $(this).attr("data-id"),
                    precio: precio
                });
                VALUES = JSON.stringify(ARRAY);
                Ajax(URL, ACTION, VALUES, function () {
                    listProductsFact();
                });
            }
        }
    });

    $(document).on('input', '.precio', function () {
        let data = $(this).val()
        $(this).val("$" + number_format(data))
    });

    $(document).on('input', '.cantidad', function () {
        let data = $(this).val()
        $(this).val(number_format(data))
    });

    $("#saveFactura").on('click', function () {
        URL = URI() + "/controller/temp-factura.php";
        ACTION = 7;
        ARRAY = [];
        ARRAY.push({
            id_temp_factura: 1,
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            $("#addFactura").modal("hide");
            facturas();
        });
    });

    $(document).on("click", "#print", function () {
        let val = $(this).attr('data-id')
        URL = URI() + "/controller/generarDocumento/imprimirPDF.php?id=" + val;
        printPdf(URL)
    });

    $(document).on("click", "#guardarPDF", function () {
        let val = $(this).attr('data-id')
        URL = URI() + "/controller/generarDocumento/guardarPDF.php?id=" + val;
        window.location.href = URL;
    });

    $(document).on("click", "#delete", function () {
        let val = $(this).attr('data-id');
        swal({
            title: "¿Estas seguro?",
            text: "Se eliminara la factura: " + val,
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "basic-button gray-button",
                    closeModal: true,
                },
                confirm: {
                    text: "Eliminar",
                    value: true,
                    visible: true,
                    className: "basic-button red-button",
                    closeModal: true
                }
            },
            dangerMode: true,
            customClass: 'basic-button'
        }).then((willDelete) => {
            if (willDelete) {
                URL = URI() + "/controller/facturas.php";
                ACTION = 7;
                ARRAY = [];
                ARRAY.push({
                    id: val,
                    estado: 0,
                });
                VALUES = JSON.stringify(ARRAY);
                Ajax(URL, ACTION, VALUES, function (response) {
                    swal({
                        text: "Se ha eliminado la factura correctamente!",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Ok",
                                value: true,
                                visible: true,
                                className: "basic-button",
                                closeModal: true
                            }
                        }
                    });
                    URL = URI() + "/controller/facturas.php";
                    ACTION = 3;
                    ARRAY = [];
                    ARRAY.push({
                        estado: 0
                    });
                    VALUES = JSON.stringify(ARRAY);
                    Ajax(URL, ACTION, VALUES, function (response) {
                        $("#FacturasEliminadas").bootstrapTable("load", response);
                    });
                    facturas();
                });
            }
        });
    });

    $('#facturasEliminadas').on('click', function () {
        URL = URI() + "/controller/facturas.php";
        ACTION = 3;
        ARRAY = [];
        ARRAY.push({
            estado: 0
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            $("#FacturasEliminadas").bootstrapTable({
                data: response,
                striped: true,
                pageSize: 20,
                paginationHAlign: true,
                filterControl: true,
                showExport: false,
                exportTypes: ["excel"],
                columns: [
                    [{
                        field: "ID",
                        title: "No. Factura",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "CODIGO",
                        title: "CODIGO",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true,
                        visible: true
                    }, {
                        field: "NOMBRE",
                        title: "CLIENTE",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "VENDEDOR",
                        title: "VENDEDOR",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "FECHA",
                        title: "FECHA",
                        align: "center",
                        valign: "middle",
                        rowspan: 2,
                        sortable: true
                    }, {
                        field: "ACCTION",
                        title: "RESTAURAR",
                        align: "center",
                        valign: "middle",
                        //width: 380,
                        rowspan: 2,
                        formatter: function (value) {
                            return (
                                '<button id="restore" data-id="' + value + '" class="basic-button gray-button" type="button"><span class="fa fa-repeat"></span></button>'
                            );
                        }
                    }],
                    []
                ]
            });
        });
    });

    $(document).on('click', '#restore', function () {
        let val = $(this).attr('data-id');
        URL = URI() + "/controller/facturas.php";
        ACTION = 7;
        ARRAY = [];
        ARRAY.push({
            id: val,
            estado: 1,
        });
        VALUES = JSON.stringify(ARRAY);
        Ajax(URL, ACTION, VALUES, function (response) {
            URL = URI() + "/controller/facturas.php";
            ACTION = 3;
            ARRAY = [];
            ARRAY.push({
                estado: 0
            });
            VALUES = JSON.stringify(ARRAY);
            Ajax(URL, ACTION, VALUES, function (response) {
                $("#FacturasEliminadas").bootstrapTable("load", response);
            });
            swal({
                text: "Factura Restaurada!",
                icon: "success",
                buttons: {
                    confirm: {
                        text: "Ok",
                        value: true,
                        visible: true,
                        className: "basic-button",
                        closeModal: true
                    }
                }
            });
            facturas();
        });
    });
});