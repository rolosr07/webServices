<?php

header("Cache-Control: no-cache, must-revalidate");

session_start();

$userInformation = json_decode($_SESSION["USER_INFORMATION"], true);

$userInformation = $userInformation[0];

if(!isset($userInformation)){
    header('Location: login.php');
}

if(isset($_POST["CerrarSession"])){
    session_destroy();
    $_SESSION["USER_INFORMATION"] = "";
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Eternal Innova</title><meta charset="UTF-8" />
        <meta name="description" content="Panel de control Eternal Innova, donde podras dar de alta todos los Equipos fabricados por Eternal, productos y servicios para funerarias y profesionales del sector."/>
        <meta name="keywords" content="eternal, eternal innova, mesit, funerarias, condolencias, libro memorial, esquelas, mesit premiun, "/><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="index.php?page=index">Eternal Innova Administración</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Bienvenido <?php echo $userInformation["nombre"]?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a><i class="icon-user"></i> Mi Perfil</a></li>
        
        <li class="divider"></li>
        <li>
            <form method="post" action="<?=$PHP_SELF;?>">
            <button class="btn-link" name="CerrarSession" type="submit"><i class="icon-key"></i> Salir</button>
            </form>
        </li>
      </ul>
    </li>
      <li class="">
          <form method="post" action="<?=$PHP_SELF;?>" style="margin-top: 6px!important; font-size: 11px!important; color: #999!important;">
              <button class="btn-link" type="submit" name="CerrarSession" title="" href="<?=$PHP_SELF;?>">
                  <i class="icon icon-share-alt">
                  </i>
                  <span class="text">Salir</span>
              </button>
          </form>
      </li>
  </ul>
</div>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<div id="sidebar"><a href="index.php?page=index" class="visible-phone"><i class="icon icon-home"></i> Inicio</a>
  <ul>
    <li class="<?php if($_GET["page"] == "index" or $_GET["page"] == ""){echo 'active';}?>"><a href="index.php?page=index"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>

    <li class="<?php if($_GET["page"] == "altaCliente" or $_GET["page"] == "asociarProducto"){echo 'submenu active';}else{ echo'submenu'; }?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Clientes</span> </a>
      <ul>
        <li class="<?php if($_GET["page"] == "altaCliente"){echo 'active';}?>"><a href="index.php?page=altaCliente">Alta de Clientes</a></li>
        <li class="<?php if($_GET["page"] == "asociarProducto"){echo 'active';}?>"><a  href="index.php?page=asociarProducto">Asociar productos a clientes</a></li>
      </ul>
    </li>
     <li class="<?php if($_GET["page"] == "floristeria"){echo 'active';}?>"> <a href="index.php?page=floristeria"><i class="icon icon-gift"></i> <span>Alta de Floristerias</span></a> </li>
     <li class="<?php if($_GET["page"] == "altaProducto"){echo 'active';}?>"> <a href="index.php?page=altaProducto"><i class="icon icon-gift"></i> <span>Alta de productos</span></a> </li>
    <li class="<?php if($_GET["page"] == "imagenesReligiosas" or $_GET["page"] == "flores" or $_GET["page"] == "vela" or $_GET["page"] == "musica"){echo 'submenu active';}else{ echo'submenu'; }?>"> <a href="#"><i class="icon icon-picture"></i> <span>Imagenes</span> </a>
      <ul>
        <li class="<?php if($_GET["page"] == "imagenesReligiosas"){echo 'active';}?>"><a href="index.php?page=imagenesReligiosas">Alta de Imagenes religiosas</a></li>
        <li class="<?php if($_GET["page"] == "flores"){echo 'active';}?>"><a href="index.php?page=flores">Alta de Flores</a></li>
        <li class="<?php if($_GET["page"] == "vela"){echo 'active';}?>"><a href="index.php?page=vela">Alta de Velas</a></li>
        <li class="<?php if($_GET["page"] == "musica"){echo 'active';}?>"><a href="index.php?page=musica">Alta de Música</a></li>
      </ul>
    </li>

     <li class="<?php if($_GET["page"] == "librosPendientes" or $_GET["page"] == "librosServidos"){echo 'submenu active';}else{ echo'submenu'; }?>" > <a href="#"><i class="icon icon-book"></i> <span>Pedidos de Libros</span> </a>
      <ul>
        <li class="<?php if($_GET["page"] == "librosPendientes"){echo 'active';}?>"><a href="index.php?page=librosPendientes">Pendientes de servir</a></li>
        <li class="<?php if($_GET["page"] == "librosServidos"){echo 'active';}?>"><a href="index.php?page=librosServidos">Servidos</a></li>
      </ul>
    </li>

    <li class="<?php if($_GET["page"] == "ventaFecha" or $_GET["page"] == "ventaFuneraria" or $_GET["page"] == "ventaFloristeria" or $_GET["page"] == "ventaDifunto" or $_GET["page"] == "ventaAparato"){echo 'submenu active';}else{ echo'submenu'; }?>"> <a href="#"><i class="icon icon-copy"></i> <span>Listados de Ventas</span> </a>
      <ul>
        <li class="<?php if($_GET["page"] == "ventaFecha"){echo 'active';}?>"><a href="index.php?page=ventaFecha">Ventas por fecha</a></li>
        <li class="<?php if($_GET["page"] == "ventaFuneraria"){echo 'active';}?>"><a href="index.php?page=ventaFuneraria">Ventas por funeraria</a></li>
        <li class="<?php if($_GET["page"] == "ventaFloristeria"){echo 'active';}?>"><a href="index.php?page=ventaFloristeria">Ventas por floristeria</a></li>
        <li class="<?php if($_GET["page"] == "ventaDifunto"){echo 'active';}?>"><a href="index.php?page=ventaDifunto">Ventas al difunto</a></li>
        <li class="<?php if($_GET["page"] == "ventaAparato"){echo 'active';}?>"><a href="index.php?page=ventaAparato">Ventas por equipos</a></li>
      </ul>
    </li>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
    <?php
    if($_GET["page"] == "index"){
        include "partial/_index.php";
    }
    else if($_GET["page"] == "altaCliente"){
        include "partial/_altaCliente.php";
    }
    else if($_GET["page"] == "altaProducto"){
        include "partial/_altaProducto.php";
    }
    else if($_GET["page"] == "asociarProducto"){
        include "partial/_asociarProducto.php";
    }
    else if($_GET["page"] == "flores"){
        include "partial/_flores.php";
    }
    else if($_GET["page"] == "floristeria"){
        include "partial/_floristeria.php";
    }
    else if($_GET["page"] == "imagenesReligiosas"){
        include "partial/_imagenesReligiosas.php";
    }
    else if($_GET["page"] == "librosPendientes"){
        include "partial/_librosPendientes.php";
    }
    else if($_GET["page"] == "librosServidos"){
        include "partial/_librosServidos.php";
    }
    else if($_GET["page"] == "musica"){
        include "partial/_musica.php";
    }
    else if($_GET["page"] == "vela"){
        include "partial/_vela.php";
    }
    else if($_GET["page"] == "ventaAparato"){
        include "partial/_ventaAparato.php";
    }
    else if($_GET["page"] == "ventaDifunto"){
        include "partial/_ventaDifunto.php";
    }
    else if($_GET["page"] == "ventaFecha"){
        include "partial/_ventaFecha.php";
    }
    else if($_GET["page"] == "ventaFloristeria"){
        include "partial/_ventaFloristeria.php";
    }
    else if($_GET["page"] == "ventaFuneraria"){
        include "partial/_ventaFuneraria.php";
    }
    else{
        include "partial/_index.php";
    }
    ?>
</div>


<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> Web realizada por Informatica Manchuela </div>
</div>

<!--end-Footer-part-->

<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<script src="js/matrix.interface.js"></script> 
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script>

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
