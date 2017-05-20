<?php

require_once "dbconexion.php";

$db = new BaseDatos();

if($db->conectar()){
    $db->placaInformationNeedDownload(1);
    $db->desconectar();
}