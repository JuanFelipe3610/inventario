<?php 
    require_once('../config.php');

    use controller\UserConfigController;
    use controller\session;

    if (isset($_POST['pcUser']) && isset($_POST['pcPasword'])) {
        $user = $_POST['pcUser'];
        $pass = $_POST['pcPasword'];
        $objUserConfig = new UserConfigController;
        $result = $objUserConfig->login($user, $pass);
    }
    $dataUser = session::get('DATAUSER');
    if (isset($dataUser['SESSION'])) {
        if ($dataUser['SESSION'] == 1) {
            header('Location: dashboard');
        }
    } 
    /*echo tempnam('C:\xampp\htdocs\PC-Barranquilla\view', 'ok');*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/elegant-icons-style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/jpeg" href="../img/logo.jpg">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login | PC, Barranqilla</title>
</head>
<body>
    <div class="login">
        <h2><img src="../img/logo.jpg" alt=""></h2>
        <div class="inputs">
            <form action="login" method="post" id="myformlogin">
                <div class="input-login">
                    <div class="icon icon_id-2"></div>
                    <input type="user" name="pcUser" placeholder="Usuario o E-Mail" required id="user">
                </div>
                <div class="input-login">
                    <div class="icon icon_key"></div>
                    <input type="password" name="pcPasword" placeholder="Contraseña" required id="pass">
                </div>            
            </form>
            <button id="btn-login" type="submit"><i class="fa fa-sign-in"></i><p>Iniciar Sesión</p><div class="loading"></div></button>
            <p id="error"><?=(isset($result['MESSAGE'])) ? $result['MESSAGE'] : null ?></p>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../lib/paginationjs/src/pagination.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="../js/bootstrap-table.min.js"></script>
    <script src="../js/bootstrap-table-group-by.js"></script>
</body>
</html>