<?php

require_once "../config.php";
require 'tools/Medoo.php';

use Medoo\Medoo;

class dbMedoo
{
    public function conectar()
    {
        $db = new medoo(array(
            'database_type' => 'mysql',
            'database_name' => DBNAME,
            'server' => HOST,
            'username' => USER,
            'password' => PASS
        ));

        return $db;
    }

    public function registroCliente($array)
    {
        $db = $this->conectar();
        $db->insert("cliente", $array);
    }
}

	
