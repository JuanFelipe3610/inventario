<div class="login">
    <img class="centered" src="<?=base_url('/resources/img/logo.png');?>" alt="">
    <h3 class="centered">Modular Software Solutions</h3>
    <div class="inputs">
        <form action="/login" method="post" id="myformlogin">
            <div class="input-login">
                <div class="icon icon_id-2"></div>
                <input type="user" name="pcUser" placeholder="Usuario o E-Mail" required id="user">
            </div>
            <div class="input-login">
                <div class="icon icon_key"></div>
                <input type="password" name="pcPasword" placeholder="Contraseña" required id="pass">
            </div>            
        </form>
        <button id="btn-login" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i><p>Iniciar Sesión</p><div class="loading"></div></button>
        <p id="error"></p>
    </div>
</div>

