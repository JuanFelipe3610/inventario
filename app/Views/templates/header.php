<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link rel="stylesheet" href="<?=base_url('/resources/css/bootstrap-theme.css');?>"-->
    <link rel="stylesheet" href="<?=base_url('/resources/css/elegant-icons-style.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/font-awesome.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/lib/paginationjs/dist/pagination.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/bootstrap-table.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/bootstrap-table-group-by.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/style.css');?>">
    <script src="<?=base_url('/resources/lib/sweetalert2/sweetalert2.js');?>"></script>
    <link rel="icon" type="image/jpeg" href="<?=$logo = base_url('/resources/img/logo.png');?>">
    <title><?= esc($title) ?></title>
</head>
<body class="sidebar-mini">
    <div id="cssload-box">
        <div class="cssload-alert">
            <div class="cssload-box-loading"></div>
            <h3 style="align-self: center;">Cargando...</h3>
        </div>        
    </div>
    <div class="wrapper">
        <header class="header">
            <div class="box-logo">
                <div class="buttonMenu">
                    <hr class="stik1">
                    <hr class="stik2">
                    <hr class="stik3">
                </div>
                <a href="/"><h2>Fast Inventory</h2></a>
            </div>
            <div class="nav"> 
                <div class="btn-search"><span class="fa fa-search"></span></div>  
                <input type="text">         
            </div>
            <nav>
                <div class="button-user">                    
                    <div class="user">
                        <img src="<?=$logo;?>" alt="">
                        <div>
                            <small><?=$controllerData['userData']->username;?></small><br>
                            <small><i class="fa fa-user" aria-hidden="true"></i><?=$controllerData['userData']->username;?></small>  
                        </div>
                    </div>
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </div>
                <div class="user-menu closeMenu">
                    <?=$menu->showMenu('', 'TopRight')?>
                </div>
            </nav>
            
        </header>
        <aside class="main-sidebar overflow">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?=base_url('/resources/img/logo.jpg');?>" alt="">
                    </div>
                    <div class="pull-left info">
                      <p></p>
                      <a href="#"><i class="fa fa-circle text-success" aria-hidden="true"></i> En linea</a>
                    </div>
                </div>  
                <?=$menu->showMenu('sidebar-menu', 'Left')?>                               
            </section>
            <!--div class="lock-menu fa fa-unlock"></div-->
        </aside>
        <section class="main-content">
            <ul class="window">
                <li class="active" data-id="1"><?=$winname?> <i class="icon_close" aria-hidden="true"></i></li>
            </ul>
            <ol class="breadcrumb">
                <li><i class="icon_house_alt" aria-hidden="true"></i>Inicio</li>
                <li><?=$winname?></li>
            </ol>
            <div class="content active" data-id="1">
                <div class="sidebar-hover-label"><a href=""></a></div>