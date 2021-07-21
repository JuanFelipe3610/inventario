<?php
    require_once('../config.php');
    use controller\session;
    session::destroy();
    header('Location: login');
?>