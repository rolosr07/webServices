<?php

header("Cache-Control: no-cache, must-revalidate");

session_start();

$userInformation = json_decode($_SESSION["USER_INFORMATION"], true);

$userInformation = $userInformation[0];


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
  <h1><a href="dashboard.html">Eternal Innova Administración</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Bienvenido <?php echo $userInformation["nombre"]?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> Mi Perfil</a></li>
        
        <li class="divider"></li>
        <li><a href="login.php"><i class="icon-key"></i> Salir</a></li>
      </ul>
    </li>
    
   
    <li class=""><a title="" href="login.php"><i class="icon icon-share-alt"></i> <span class="text">Salir</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Inicio</a>
  <ul>
    <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Clientes</span> </a>
      <ul>
        <li><a href="altacliente.html">Alta de Clientes</a></li>
        <li><a href="asociarproducto.html">Asociar productos a clientes</a></li>
       
      </ul>
    </li>
     <li> <a href="floristeria.html"><i class="icon icon-gift"></i> <span>Alta de Floristerias</span></a> </li>
    <li> <a href="altaproducto.html"><i class="icon icon-gift"></i> <span>Alta de productos</span></a> </li>

    <li class="submenu"> <a href="#"><i class="icon icon-picture"></i> <span>Imagenes</span> </a>
      <ul>
        <li><a href="imagenesreligiosas.html">Alta de Imagenes religiosas</a></li>
        <li><a href="flores.html">Alta de Flores</a></li>
        <li><a href="vela.html">Alta de Velas</a></li>
        <li><a href="musica.html">Alta de Música</a></li>
       
      </ul>
    </li>

     <li class="submenu"> <a href="#"><i class="icon icon-book"></i> <span>Pedidos de Libros</span> </a>
      <ul>
        <li><a href="librospendientes.html">Pendientes de servir</a></li>
        <li><a href="librosservidos.html">Servidos</a></li>
        
       
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-copy"></i> <span>Listados de Ventas</span> </a>
      <ul>
        <li><a href="ventafecha.html">Ventas por fecha</a></li>
        <li><a href="ventafuneraria.html">Ventas por funeraria</a></li>
         <li><a href="ventafloristeria.html">Ventas por floristeria</a></li>
        <li><a href="ventadifunto.html">Ventas al difunto</a></li>
        <li><a href="ventaaparato.html">Ventas por equipos</a></li>
        
       
      </ul>
    </li>


    
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">


<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="index.html"> <i class="icon-dashboard"></i>  Inicio </a> </li>
        <li class="bg_lg span3"> <a href="librospendientes.html"> <i class="icon-book"></i> Libros Pendientes</a> </li>
        <li class="bg_ly"> <a href="altacliente.html"> <i class="icon-group"></i> Alta Cliente </a> </li>
        <li class="bg_lo"> <a href="altaproducto.html"> <i class="icon-th"></i> Alta productos</a> </li>
        <li class="bg_ls"> <a href="flores.html"> <i class="icon-leaf"></i> Alta Flores</a> </li>
        

      </ul>
    </div>
<!--End-Action boxes-->    


    <hr/>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Ultimas ventas de flores físicas</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <li>
                
                <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 49,50 €</a> </p>
                </div>
              </li>
              <li>
               
                 <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 49,50 €</a> </p>
                </div>
              </li>
              <li>
               
                 <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 49,50 €</a> </p>
                </div>
             
            </ul>
          </div>
        </div>
        
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Ultimas ventas de flores virtuales</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <li>
                
                <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 1,20€ €</a> </p>
                </div>
              </li>
              <li>
               
                 <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 1,20 €</a> </p>
                </div>
              </li>
              <li>
               
                 <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 1,20 €</a> </p>
                </div>
             
            </ul>
          </div>
        </div>
        

         <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Libros pendientes de servir más antigüos.</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <li>
                
                <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Libro standar. Precio 20€ €</a> </p>
                </div>
              </li>
              <li>
               
                 <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Libro Premium. Precio 25 €</a> </p>
                </div>
              </li>
              <li>
               
                 <div class="article-post"> <span class="user-info"> Fecha: 99/99/9999 Funeraria: La milagros Difunto: Miguel Fernandez Fernandea </span>
                  <p><a href="#">Ramo de flores Rojas. Precio 1,20 €</a> </p>
                </div>
             
            </ul>
          </div>
        </div>
        
      </div>
      
       


        <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Libro más vendido</a></li>
              <li><a data-toggle="tab" href="#tab2">Ramo más vendido</a></li>
              <li><a data-toggle="tab" href="#tab3">Vela más encendida</a></li>
              <li><a data-toggle="tab" href="#tab4">Musica más escuchada</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>Muestra la fotografia y la cantidad de libros vendidos.</p>
              <img src="img/libro.png" width="100" height="200"  alt="demo-image"/></div>
            <div id="tab2" class="tab-pane"> 
              <p>Muestra la imagen y cantidad del ramo de flores más vendido.</p>
              <img src="img/corona.jpeg" width="100" height="200" alt="demo-image"/>
            </div>
            <div id="tab3" class="tab-pane">
              <p>Muestra la imagen y cantidad de la vela más vendida. </p>
              <img src="img/vela.jpeg" width="100" height="200" alt="demo-image"/></div>
               <div id="tab4" class="tab-pane">
              <p>Muestra la imagen y cantidad de la canción más reproducida. </p>
              <img src="img/musica.jpeg" width="100" height="200" alt="demo-image"/></div>
          </div>
         
          </div>
        </div>
      </div>
    </div>
  </div>
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
