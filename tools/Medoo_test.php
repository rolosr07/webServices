<?php
/**
 * Created by PhpStorm.
 * User: rolando.soto
 * Date: 29/05/2017
 * Time: 3:35 PM
 */
require 'Medoo.php';

use Medoo\Medoo;

$db = new medoo(array(
    'database_type' => 'mysql',
    'database_name' => 'test',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root'
));

$db->insert("account", [
    "user_name" => "foo",
    "email" => "foo@bar.com"
]);


$datas = $db->select("account", "*");

foreach($datas as $data)
{
    echo "user_name:" . $data["user_name"] . " - email:" . $data["email"] . "<br/>";
}