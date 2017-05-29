<?php

require_once "dbconexion.php";

$db = new BaseDatos();

if($db->conectar()){
    $db->test7();
    $db->desconectar();
}