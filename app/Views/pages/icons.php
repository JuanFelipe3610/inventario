<?php 
    require_once('../config.php');
    require_once('../header.php');
?>
<style type="text/css">

    .icon_font_awesome, .elegant-icon {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
    }

    .icon_font_awesome div, .elegant-icon div {
        display: flex;
        padding: 10px;
        width: 150px;
        border: 0px solid transparent;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        margin: 5px;
        border-radius: 3px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #eeeeeeee;
    }

    .icon_font_awesome h1 , .elegant-icon h1 {
        width: 100%;
        text-align: center;
        padding: 10px;
        color: #4a99f3;
        margin-bottom: 15px;
    }

    .icon_font_awesome p, .elegant-icon p {
        margin-top: 12px;
        font: menu;
    }

    .icon_font_awesome i, .elegant-icon i{
        font-size: 25px;
    }
</style>
<h3 class="page-header"><i class="icon_image"></i>Iconos</h3>
<?php 
    include(DIRNAME.'/controller/icons.php');
    $objIcon = new IconsController();
?>
<div class="box-basic">
    <div class="box-header">
        <h3>Font awesome icons</h3>
        <button class="box-header-button fa fa-minus data-widget-collapse"></button>
    </div>
    <div class="icon_font_awesome box-swap">
        <?=$objIcon->gtIcons('font-awesome')?>
    </div>  
</div>
<div class="box-basic">
    <div class="box-header">
        <h3>Elegant icons</h3>
        <button class="box-header-button fa fa-minus data-widget-collapse"></button>
    </div>
    <div class="elegant-icon box-swap">
        <?=$objIcon->gtIcons('elegant-icon')?>
    </div>
</div>
<?php require_once('../footer.php'); ?>