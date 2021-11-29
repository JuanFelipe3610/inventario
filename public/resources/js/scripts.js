window.addEventListener('load', () => {
    const loader = document.getElementById('cssload-box');
    setTimeout( function() {
        loader.style.opacity = 0;
        loader.style.visibility = "hidden";
    }, 100)
});

$(window).blur(function() {
    $('#contexmenu').slideUp(100)
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

$(document).ready(function() {
    $(document).bind("contextmenu", function(e) {
        return false;
    });
    //checkCookie()
});

$(function() {
    $(document).on("click", function(e) {
        var container = $(".user-menu");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            //Se ha pulsado en cualquier lado fuera de los elementos contenidos en la variable container
            $('.user-menu').removeClass('openMenu')
            $('.user-menu').addClass('closeMenu')
            $(".button-user").removeAttr('style')
        }
    });

    $(".button-user").on("click", function(event) {
        if ($('.user-menu').hasClass('closeMenu')) {
            $('.user-menu').removeClass('closeMenu')
            $('.user-menu').addClass('openMenu')
            $(this).css({
                background: '#fff',
                borderBottomRightRadius: '0px',
                borderBottomLeftRadius: '0px',
                color: 'rgb(116, 116, 116)'
            });
        } else {
            $('.user-menu').removeClass('openMenu')
            $('.user-menu').addClass('closeMenu')
            $(this).removeAttr('style')
        }
        event.stopImmediatePropagation();
    });
});

function URI() {
    var DIR_PATH = location.protocol + '//' + location.host;
    return DIR_PATH;
}

function dataTime() {
    var data = new Date();
    var date = data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();
    var time = data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();
    var dateTime = date + ' ' + time;
    return dateTime;
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}

function ajax(URL, DATA, FN) {
    $.ajax({
        type: "POST",
        url: URL,
        async: false,
        data: DATA,
		dataType: "JSON",
        jsonp: "callback",
        jsonpCallback: "JasonpCallback",
        success: function(response) {
            FN(response);
        }
    });
}

function createTable(containerPagination, containerData, size, dataSources) {
    $('#' + containerPagination).pagination({
        dataSource: dataSources,
        pageSize: size,
        autoHidePrevious: true,
        autoHideNext: true,
        callback: function(data, pagination) {
            function template(array) {
                var dataHtml = '<table border=1>';
                $.each(array, function(index, item) {
                    dataHtml += item;
                });
                dataHtml += '</table>';
                return dataHtml;
            }
            var html = template(data);
            $('#' + containerData).html(html);
        }
    });
}

var mouseStop = null;
var Time = 1800000; //tiempo en milisegundos que espera para efectuarse la funcion
$(document).on('mousemove', function() {
    if (URI() + "/login" != location.href) {
        clearTimeout(mouseStop);
        mouseStop = setTimeout(Myfunction, Time);
    }
});

function Myfunction() {
    swal({
        title: "A estado inactivo 30 minutos",
        text: "Se cerrara la sessión",
        icon: "warning",
        dangerMode: true,
    }).then(() => {
        window.location.href = URI() + "/logout";
    }); //aqui efectua la funcion cuando dejas de mover el raton
}

$(document).ready(function() {
    //$("html").niceScroll({styler:"fb",cursorcolor:"#007AFF", cursorwidth: '6', cursorborderradius: '10px', background: '#F7F7F7', cursorborder: '', zindex: '1000',});
    //$(".content").niceScroll({styler:"fb",cursorcolor:"#007AFF", cursorwidth: '3', cursorborderradius: '10px', background: '#F7F7F7', cursorborder: '', railpadding: {top: 110, right: 0,left: 0,bottom: 0}});

    var menu = getCookie('menu')
    if (menu == 'close') {
        $('.sidebar-mini').addClass('sidebar-collapse')
        $('.buttonMenu').addClass('buttonMenuOpen')
        $('.main-content').addClass('content-open')
    }

    $(document).on("click", ".buttonMenu", function() {
        if ($('.sidebar-mini').hasClass('sidebar-collapse')) {
            setCookie("menu", 'open', 365);
            $('.sidebar-mini').removeClass('sidebar-collapse')
            $('.buttonMenu').removeClass('buttonMenuOpen')
            $('.main-content').removeClass('content-open')
        } else {
            setCookie("menu", 'close', 365);
            $('.sidebar-mini').addClass('sidebar-collapse')
            $('.buttonMenu').addClass('buttonMenuOpen')
            $('.main-content').addClass('content-open')
        }
    });

    $(document).on("click", ".lock-menu", function() {
        if ($('.lock-menu').hasClass('fa-unlock')) {
            $('.lock-menu').removeClass('fa-unlock')
            $('.lock-menu').addClass('fa-lock')
        } else {
            $('.lock-menu').removeClass('fa-lock')
            $('.lock-menu').addClass('fa-unlock')
        }
    });

    $(document).on('input', '.input-number', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $(document).on('click', '.data-widget-collapse', function() {
        box = $(this).parent().parent().find('.box-swap');
        if (box.attr('style')) {
            $(this).removeClass('fa-plus')
            $(this).addClass('fa-minus')
            box.slideDown(300)
        } else {
            $(this).removeClass('fa-minus')
            $(this).addClass('fa-plus')
            box.slideUp(300)
        }
    });

    $('.tooltips').tooltip();

    //Aqui me coloca la clase active a el menu de la izquierda dependiendo de url
    /*var pathname = window.location.pathname
    $('ul.sidebar-menu li a[href="' + pathname + '"]').parent().addClass('active')*/

    function isOverflowing(element) {
        return (element.scrollWidth > element.offsetWidth);
    }

    function createWindow(){
        content = $('.main-content')
        ul = $('.window')
        li = ul.children('li') 
        selected = li[li.length - 1]
        id = parseInt($(selected).attr('data-id')) + 1
        winButton = '<li class="active" data-id="'+id+'">Nueva ventana <i class="icon_close"></i></li>'
        windows = '<div class="content active" data-id="'+id+'">Nueva ventana '+id+'</div>'
        if (ul.children('li').hasClass('active')) {
            ul.children('li').removeClass('active')
        }
        ul.append(winButton)
        if (content.children('div').hasClass('active')) {
            content.children('div').removeClass('active')
        }
        content.append(windows)

        var position = $('.window .active').offset()
        ul.animate({scrollLeft: position.left})
    }

    function changeWindow(element){
        content = $('.main-content')
        child = content.children('div')
        ul = $('.window')
        li = ul.children('li')
        li.removeClass('active')
        element.addClass('active')
        child.removeClass('active')
        child.each(function(index, el) {
            if ($(el).attr('data-id') == element.attr('data-id')) {
                $(el).addClass('active')
            }
        });       
    }

    /*$(document).on('click', '#crearFactura', function() {
        createWindow()
    });*/

    $(document).on("click", ".window li", function() {
        changeWindow($(this))
    });

    $(document).on('click', '.btn-collapse', function() {
        box = $(this).parent().parent().find('.second-buttons');
        if (box.css('display') == 'none') {
            $(this).removeClass('fa-caret-down')
            $(this).addClass('fa-caret-up')
            box.slideDown(300)
        } else {
            $(this).removeClass('fa-caret-up')
            $(this).addClass('fa-caret-down')
            box.slideUp(300)
        }
    });

    $(document).on('click', '.sidebar-menu li', function() {
        box = $(this).find('.submenu');
        if (box.css('display') == 'none') {
            $(this).find('.fa-caret-down').addClass('fa-caret-up')
            $(this).find('.fa-caret-down').removeClass('fa-caret-down')            
            box.slideDown(300)
        } else {
            $(this).find('.fa-caret-up').addClass('fa-caret-down')
            $(this).find('.fa-caret-up').removeClass('fa-caret-up')            
            box.slideUp(300)
        }
    });

    $('.content').on("scroll", function(){
        var desplazamientoActual = $(this).scrollTop();
        var breadcrumb = $(".breadcrumb");
        if(desplazamientoActual > 1){
            breadcrumb.css('box-shadow', '0px 3px 3px -1px #b9b9b9');
        }
        if(desplazamientoActual < 1){
            breadcrumb.removeAttr('style');
        }
    });

    $('.sidebar').hover(function(){
        $('body').removeClass('sidebar-collapse')
    }, function(){
        if($('.buttonMenu').hasClass('buttonMenuOpen')){
            $('body').addClass('sidebar-collapse')
            box = $(this).find('.submenu')
            $(this).find('.fa-caret-up').addClass('fa-caret-down')
            $(this).find('.fa-caret-up').removeClass('fa-caret-up')    
            box.slideUp(300)
        }
    })
});

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