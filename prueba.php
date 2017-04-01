<?php

require_once "dbconexion.php";

$db = new BaseDatos();

if($db->conectar()){
    $sd = $db->registrarUsuario('Jorge','Mora','jmora@gmail.com',1);
    echo 'rolo';
    echo $sd;
    $db->desconectar();
}