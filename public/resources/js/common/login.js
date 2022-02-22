var DATA = [];
const URL = URI()+'/LoginController/';
var ACTION = null;

$(document).keypress('.input-login', function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        login();
    }
});

$(document).on("click", "#btn-login", function() {
    login();
});

const login = () =>{  
    let user = $('#user').val();
    let pass = $('#pass').val();
    if (user == '') {
        $('#user').focus();
        $("#btn-login").removeClass('btn-login-load');
    } else if (pass == ''){
        $('#pass').focus();
        $("#btn-login").removeClass('btn-login-load');
    } else {
        $("#btn-login").addClass('btn-login-load');
        ajax(`${URL}login`, { user, pass}, function (response) {
            setTimeout(function() {
                if (response.status == 0) {
                    $("#error").text('')
                    window.location.href = URI() + "/";
                } else {
                    $("#error").text(response.mensaje)
                }
                $("#btn-login").removeClass('btn-login-load');
            }, 1500);
        })
        
    }
}