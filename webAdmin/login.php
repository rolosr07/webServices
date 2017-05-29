<?php

session_start();

require_once "../nusoap.php";
$cliente = new nusoap_client("http://".$_SERVER["HTTP_HOST"]."/webServices/user.php");

$error = $cliente->getError();

if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}

$validation = "none";

if (isset($_POST["btn_entrar"]))
{
    $userName = $_POST["userName"];
    $pass = $_POST["password"];
    $result = $cliente->call("login", array("userName" => $userName, "password" => $pass));

    $decode = json_decode($result, true);

    $decode = $decode[0];

    if(isset($decode) and $decode["activo"] == true){
        $_SESSION["USER_INFORMATION"] = $result;
        header('Location: index.php');
    }else{
        $validation = "Usuario o contrase&ntilde;a invalidos!";
    }
}

?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">

<head>
    <title>Eternal Innova</title><meta charset="UTF-8" />
    <meta name="description" content="Panel de control Eternal Innova, donde podras dar de alta todos los Equipos fabricados por Eternal, productos y servicios para funerarias y profesionales del sector."/>
    <meta name="keywords" content="eternal, eternal innova, mesit, funerarias, condolencias, libro memorial, esquelas, mesit premiun, "/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="js/angular.min.js"></script>

    </head>
    <body ng-app="postLogin" ng-controller="PostController as postCtrl">
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="<?=$PHP_SELF;?>" method="post" ng-submit="postCtrl.postForm()">
				 <div class="control-group normal_text"> <h3><img src="img/logo1.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="userName" placeholder="Usuario" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Contraseña" />
                        </div>
                    </div>
                </div>
                <br>
                <div class="alert alert-danger" ng-show="<?php echo $validation; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $validation; ?>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Recuperar contraseña</a></span>
                    <span class="pull-right"><button type="submit" class="btn btn-success" name="btn_entrar"/> Entrar</button></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Introduzca su email para restablecer la contraseña.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="Introduzca su email" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Volver a pagina de entrada</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Recuperar</a></span>
                </div>
            </form>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script>
        <script src="controllers/app.js"></script>
    </body>

</html>
