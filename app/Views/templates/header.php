<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('/resources/css/elegant-icons-style.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/font-awesome.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/font-awesome.min.css');?>">
    <link href="<?=base_url('/resources/css/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('/resources/lib/paginationjs/dist/pagination.css');?>">
    <link rel="stylesheet" href="<?=base_url('/resources/css/bootstrap-table.min.css');?>">
    <link rel="icon" type="image/jpeg" href="<?=base_url('/resources/img/logo.jpg');?>">
    <!--link href="/css/bootstrap-theme.css" rel="stylesheet"-->
    <link rel="stylesheet" href="<?=base_url('/resources/css/bootstrap-table-group-by.css');?>">
    <script src="<?=base_url('/resources/lib/swalert/sweetalert.js');?>"></script>
    <link rel="stylesheet" href="<?=base_url('/resources/css/style.css');?>">
    <title>Fast Inventory</title>
</head>
<body class="sidebar-mini">
    <div class="wrapper">
        <header class="header">
            <div class="box-logo">
                <div class="buttonMenu">
                    <hr class="stik1">
                    <hr class="stik2">
                    <hr class="stik3">
                </div>
                <a href="/"><h2><?= esc($title) ?></h2></a>
            </div>
            <!--nav class="nav">            
            </nav-->
            <nav>
                <div class="button-user">
                    <!--div class="btn-search"><span class="fa fa-search"></span></div-->
                    <div class="user">
                        <img src="<?=base_url('/resources/img/logo.jpg');?>" alt="">
                        <div>
                            <small></small><br>
                            <small><i class="fa fa-user"></i></small>  
                        </div>
                    </div>
                    <i class="fa fa-caret-down"></i>
                </div>
                <div class="user-menu closeMenu">
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
                      <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
                    </div>
                </div>  
                <?=$menu->showMenu('sidebar-menu')?>                               
            </section>
            <!--div class="lock-menu fa fa-unlock"></div-->
        </aside>
        <section class="main-content">
            <ul class="window">
                <li class="active" data-id="1"><?=$winname?> <i class="icon_close"></i></li>
            </ul>
            <ol class="breadcrumb">
                <li><i class="icon_house_alt"></i>Inicio</li>
                <li></li>
            </ol>
            <div class="content active" data-id="1">
                <div class="sidebar-hover-label"><a href=""></a></div>                        
                <!--div id="cssload-box"><div class="cssload-box-loading"></div></div-->