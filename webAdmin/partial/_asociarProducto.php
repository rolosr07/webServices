<?php
/**
 * Created by PhpStorm.
 * User: rolando.soto
 * Date: 29/05/2017
 * Time: 4:12 PM
 */
?>
<div id="content-header">
    <h1>Asociar y Modificar Productos a Clientes</h1>
</div>
<div class="container-fluid">
    <hr>
    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Asociar Productos a Clientes</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="#" method="get" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Nombre de la Empresa :</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Lista despegable de la base de datos clientes" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Números de Serie :</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Lista despegable de la base de datos de clientes" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Mensaje</label>
                            <div class="controls">
                                <textarea class="span11" ></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="submit" class="btn btn-success">Borrar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Listado de productos dados de alta.</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="#" class="form-horizontal">
                        <div class="control-group">
                            <label for="normal" class="control-label">listado de todos los productos asociados para poder seleccionar y modificar o borrar en la parte izquierda<br><br> Nombre de cliente, numero serie, modelo, (organizado por cliente)</label>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
