<?php
/**
 * Created by PhpStorm.
 * User: rolando.soto
 * Date: 29/05/2017
 * Time: 3:59 PM
 */
?>

<!--Action boxes-->
<div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb"> <a href="index.php?page=index"> <i class="icon-dashboard"></i>  Inicio </a> </li>
            <li class="bg_lg span3"> <a href="index.php?page=librosPendientes"> <i class="icon-book"></i> Libros Pendientes</a> </li>
            <li class="bg_ly"> <a href="index.php?page=altaCliente"> <i class="icon-group"></i> Alta Cliente </a> </li>
            <li class="bg_lo"> <a href="index.php?page=altaProducto"> <i class="icon-th"></i> Alta productos</a> </li>
            <li class="bg_ls"> <a href="index.php?page=flores"> <i class="icon-leaf"></i> Alta Flores</a> </li>
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
                    <img src="./img/libro.png" width="100" height="200" alt="demo-image">
                </div>
                <div id="tab2" class="tab-pane">
                    <p>Muestra la imagen y cantidad del ramo de flores más vendido.</p>
                    <img src="./img/corona.jpeg" width="100" height="200" alt="demo-image"/>
                </div>
                <div id="tab3" class="tab-pane">
                    <p>Muestra la imagen y cantidad de la vela más vendida. </p>
                    <img src="./img/vela.jpeg" width="100" height="200" alt="demo-image"/></div>
                <div id="tab4" class="tab-pane">
                    <p>Muestra la imagen y cantidad de la canción más reproducida. </p>
                    <img src="./img/musica.jpeg" width="100" height="200" alt="demo-image"/></div>
            </div>

        </div>
    </div>
</div>
