<?php
    require_once "nusoap.php";
    $cliente = new nusoap_client("http://localhost:1233/webServices/user.php");

    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }

    //$result = $cliente->call("registrarUsuario", array("nombre" => "Arturo","apellido" => "Mora","email" => "email@email.com","idDifunto" => "1"));
      
    if ($cliente->fault) {
        echo "<h2>Fault</h2><pre>";
        print_r($result);
        echo "</pre>";
    }
    else {
        $error = $cliente->getError();
        if ($error) {
            echo "<h2>Error</h2><pre>" . $error . "</pre>";
        }
        else {
            echo "<h2>Usuario:</h2><pre>";
            echo $result;
            echo "</pre>";
        }
    }