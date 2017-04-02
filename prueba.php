<?php

require_once "dbconexion.php";

$db = new BaseDatos();

if($db->conectar()){
    echo $db->getLogo();
    echo 'rolo';

    $db->desconectar();
}