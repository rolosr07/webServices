<?php
    require_once "nusoap.php";
      
        function getProd($categoria) {
        if ($categoria == "libros") {
            return join(",", array(
                "El se�or de los anillos",
                "Los l�mites de la Fundaci�n",
                "The Rails Way rolo"));
        }
        else {
                return "No hay productos de esta categoria";
        }
    }
      
    $server = new soap_server();
    $server->register("getProd");
    $server->service($HTTP_RAW_POST_DATA);
?>