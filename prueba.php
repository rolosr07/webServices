<?php

require_once "dbconexion.php";

$db = new BaseDatos();

if($db->conectar()){

    $db->desconectar();
}