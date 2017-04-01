<?php
    require_once "nusoap.php";
      
        function getProd($categoria) {
        if ($categoria == "libros") {
            return join(",", array(
                "El señor de los anillos",
                "Los límites de la Fundación",
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