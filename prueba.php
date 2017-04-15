<?php

require_once "dbconexion.php";

$db = new BaseDatos();

if($db->conectar()){
    $db->test9();
     $db->test10();

    $db->desconectar();
}