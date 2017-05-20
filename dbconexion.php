<?php

require_once "config.php";

class BaseDatos
{
    protected $conexion;
    protected $db;

    public function conectar()
    {
        $this->conexion = mysql_connect(HOST, USER, PASS);
        if ($this->conexion == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
        $this->db = mysql_select_db(DBNAME, $this->conexion);
        if ($this->db == 0) DIE("Lo sentimos, no se ha podido conectar con la base datos: " . DBNAME);

        return true;
    }

    public function desconectar()
    {
        if ($this->conectar->conexion) {
            mysql_close($this->$conexion);
        }
    }

    public function pruebadb()
    {
        $tabla = "usuario";
        $query = mysql_query("SELECT count(*) from $tabla", $this->conexion);
        if ($query == 0) echo "Sentencia incorrecta llamado a tabla: $tabla.";
        else {
            $nregistrostotal = mysql_result($query, 0, 0);
            echo "Hay $nregistrostotal registros en la tabla: $tabla.";
            mysql_free_result($query);
        }
    }
	
	public function login($userName, $password)
    {
        $query = mysql_query("SELECT count(*) from `usuario` where `userName`= '".$userName."' and `password` ='".$password."' and `activo` = true;", $this->conexion);
        if ($query == 0)
            return false;
        else {
            $nregistrostotal = mysql_result($query, 0, 0);
            mysql_free_result($query);
			if($nregistrostotal == 0){
				return false;
			}else
			{
				return true;
			}

        }
    }

    public function userInformation($userName)
    {
        $result = mysql_query("SELECT u.*, ua.idDifunto, CONCAT(d.nombre, ' ', d.apellidos) as nombreDifunto  FROM `usuario` u LEFT JOIN `usuarioautorizado` ua ON u.`idUsuario` = ua.`idUsuario` LEFT JOIN `difunto` d ON ua.idDifunto = d.idDifunto where u.`userName`= '".$userName."' and u.`activo` = true;", $this->conexion);
        if ($result == 0)
            return "";
        else {
            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function registerUser($nombre, $apellido, $userName, $password, $email, $rol)
    {
        $sql = "INSERT INTO `usuario` (`nombre`, `apellido`, `userName`, `password`, `rol`, `email`, `activo`, `borrado`, `fechaCreacion`)
                VALUES ('".$nombre."', '".$apellido."', '".$userName."','".$password."','".$rol."','".$email."', false, false, now())";

        if (mysql_query($sql, $this->conexion))
            return true;
        else {
            return false;
        }
    }

    public function updateUser($idUsuario, $nombre, $apellido, $userName, $password, $email, $rol)
    {
        $sql = "UPDATE `usuario` SET `nombre` = '".$nombre."', `apellido` = '".$apellido."', `userName` = '".$userName."', `password` = '".$password."', `rol` = '".$rol."', `email` = '".$email."' where `idUsuario` = ".$idUsuario.";";
        if (mysql_query($sql, $this->conexion))
            return true;
        else {
            return false;
        }
    }

    public function registrarDifunto($idUsuario, $idDifunto, $nombre, $apellido, $fechaNacimiento, $fechaDeceso)
    {
        if($idDifunto == 0){

            $sql = "INSERT INTO `difunto` (`nombre`,`apellidos`,`fechaNacimiento`,`fechaDefuncion`,`activo`,`borrado`,`fechaCreacion`)
                VALUES('".$nombre."','".$apellido."','".$fechaNacimiento."','".$fechaDeceso."', true, false, now());";

            if (mysql_query($sql, $this->conexion)){
                $sql2 = "INSERT INTO `usuarioautorizado` (`idUsuario`, `idDifunto`, `activo`, `borrado`, `fechaCreacion`)
                VALUES(".$idUsuario.", ".mysql_insert_id().", true, false, now());";

                if (mysql_query($sql2, $this->conexion)){
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }

        }else{

            $sqlUpdate = "UPDATE `difunto` SET `nombre` = '".$nombre."', `apellidos` = '".$apellido."', `fechaNacimiento` = '".$fechaNacimiento."', `fechaDefuncion` = '".$fechaDeceso."' WHERE `idDifunto` = ".$idDifunto.";";

            if (mysql_query($sqlUpdate, $this->conexion)){
                $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 1 WHERE `idDifunto` = ".$idDifunto.";";
                mysql_query($sqlUpdateIns, $this->conexion);
                return true;
            }
        }
    }

    public function getDifuntosList()
    {
        $result = mysql_query("SELECT * from `difunto` where  `activo` = true;", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function registrarImagenDifunto($idDifunto, $nombreImagen, $imagen, $tipoImagen){

        $sqlImagen = "INSERT INTO `imagenes` (`nombre`, `imagen`, `tipo`, `fechaCreacion`) VALUES ('".$nombreImagen."', '".$imagen."', '".$tipoImagen."', now());";

        if (mysql_query($sqlImagen, $this->conexion)){
            $idImagen = mysql_insert_id();

            $sqlImagenImagenDifunto = "INSERT INTO `imagenesdifunto` (`idDifunto`, `idImagen`) VALUES(".$idDifunto.",".$idImagen.");";

            if (mysql_query($sqlImagenImagenDifunto, $this->conexion)){
                $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 1 WHERE `idDifunto` = ".$idDifunto.";";
                mysql_query($sqlUpdateIns, $this->conexion);
                return "true";
            }else{
                return "false";
            }
        }else{
            return "false";
        }
    }

    public function getImagenesDifuntoList($idDifunto){

        $sql = "SELECT img.* FROM `imagenes` img inner join `imagenesdifunto` imgDif on img.`idImagenes` = imgDif.`idImagen` WHERE imgDif.`idDifunto` = ".$idDifunto.";";

        $result = mysql_query ($sql);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function getServiciosList()
    {
        $result = mysql_query("SELECT s.*,ts.`idTipoServicio` FROM `servicio` s INNER JOIN `tiposervicio` ts ON s.`idTipoServicio` = ts.`idTipoServicio` WHERE s.`activo` = true;", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function getRestosList()
    {
        $result = mysql_query("SELECT * FROM `lugarrestos`;", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function registrarInscripcion($idDifunto, $idImagenSuperior, $idOrla, $idEsquela, $idRestos, $esquelaPersonal){

        $sqlPlaca = "SELECT 1 FROM `inscripcion` WHERE `idDifunto` = ".$idDifunto.";";
        $result = mysql_query($sqlPlaca, $this->conexion);
        $result = mysql_result($result,0);

        if ($result){
            if(!empty($esquelaPersonal)){
                $sqlEsquela = "INSERT INTO `servicio` (`idTipoServicio`, `nombre`, `texto`, `activo`, `borrado`, `fechaCreacion`) VALUES(9,'Esquela personal ".$idDifunto."','".$esquelaPersonal."',true,false,now());";
                if (mysql_query($sqlEsquela, $this->conexion)){
                    $idEsquela = mysql_insert_id();
                }
            }

            $sqlPlaca = "UPDATE `inscripcion` SET `download` = 1, `idImagenSuperior` = ".$idImagenSuperior.", `idOrla` = ".$idOrla.", `idPoema` = ".$idEsquela.", `idLugarRestos` = ".$idRestos." WHERE `idDifunto` = ".$idDifunto.";";

            if (mysql_query($sqlPlaca, $this->conexion)){
                return "true";
            }
            else {
                return "false";
            }
        }
        else {

            if(!empty($esquelaPersonal)){
                $sqlEsquela = "INSERT INTO `servicio` (`idTipoServicio`, `nombre`, `texto`, `activo`, `borrado`, `fechaCreacion`) VALUES(9,'Esquela personal ".$idDifunto."','".$esquelaPersonal."',true,false,now());";
                if (mysql_query($sqlEsquela, $this->conexion)){
                    $idEsquela = mysql_insert_id();
                }
            }
            $sqlPlaca = "INSERT INTO `inscripcion` (`idDifunto`, `idImagenSuperior`, `idOrla`, `idPoema`, `idLugarRestos`, `activo`, `borrado`, `fechaCreacion`) VALUES (".$idDifunto.",".$idImagenSuperior.",".$idOrla.",".$idEsquela.",".$idRestos.", true, false, now());";

            if (mysql_query($sqlPlaca, $this->conexion)){
                return "true";
            }
            else {
                return "false";
            }
        }
    }

    public function getPlacaInformation($idDifunto)
    {
        $result = mysql_query("SELECT d.`nombre`, d.`apellidos`, d.`fechaNacimiento`, d.`fechaDefuncion`,
                                sis.`idServicio` as 'idImagenSuperior',
                                sis.`imagen` as 'imagenSuperior',
                                sio.`idServicio` as 'idImagenOrla',
                                sio.`imagen` as 'imagenOrla',
                                sie.`idServicio` as 'idEsquela',
                                sie.`texto` as 'esquela',
                                r.`idLugarRestos` as 'idNombreLugarRestos',
                                r.`nombre` as 'nombreLugarRestos',
                                r.`ubicacion` as 'ubicacionLugarRestos',
                                i.`download`
                                FROM `inscripcion` i 
                                INNER JOIN `difunto` d on i.`idDifunto` = d.`idDifunto` 
                                INNER JOIN `servicio` sis ON sis.`idServicio` = i.`idImagenSuperior`
                                INNER JOIN `servicio` sio ON sio.`idServicio` = i.`idOrla`
                                INNER JOIN `servicio` sie ON sie.`idServicio` = i.`idPoema`
                                INNER JOIN `lugarrestos` r ON r.`idLugarRestos` = i.`idLugarRestos`
                                WHERE i.`idDifunto` = ".$idDifunto." LIMIT 1;", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function getServiciosPorIdDifuntoYTipoDeServicioList($idDifunto, $idTipoServicio)
    {
        $result = mysql_query("SELECT s.*,u.`nombre` as 'nombreUsuario', u.`apellido` as 'apellidoUsuario', sc.`fechaCreacion` as 'fechaCompra' 
                            FROM `servicio` s 
                            INNER JOIN `serviciocomprado` sc ON s.`idServicio` = sc.`idServicio`
                            INNER JOIN `usuario` u ON sc.`idUsuario` = u.`idUsuario`
                            WHERE s.`activo` = true AND sc.`activo` = true AND s.`idTipoServicio` = ".$idTipoServicio." AND sc.`idDifunto` = ".$idDifunto.";", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function getServiciosPorIdDifuntoYTipoDeServicioMensajesList($idDifunto)
    {
        $result = mysql_query("SELECT s.*,u.`nombre` as 'nombreUsuario', u.`apellido` as 'apellidoUsuario', sc.`fechaCreacion` as 'fechaCompra', sc.`activo` AS 'autorizado', sc.`idServicioComprado` FROM `servicio` s 
            INNER JOIN `serviciocomprado` sc ON s.`idServicio` = sc.`idServicio`
            INNER JOIN `usuario` u ON sc.`idUsuario` = u.`idUsuario`            
            WHERE s.`idTipoServicio` in (8,9) AND sc.`idDifunto` = ".$idDifunto.";", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function actualizarServicioComprado($idServicioComprado, $estado){

        $sqlPlaca = "UPDATE `serviciocomprado` SET `activo` = ".$estado." WHERE `idServicioComprado` = ".$idServicioComprado.";";

        if (mysql_query($sqlPlaca, $this->conexion)){
            $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 1 WHERE `idDifunto` = (SELECT `idDifunto` FROM `serviciocomprado` WHERE `idServicioComprado` = ".$idServicioComprado.");";
            mysql_query($sqlUpdateIns, $this->conexion);
            return "true";
        }
        else {
            return "false";
        }
    }

    public function getUsuariosAutorizadosDifuntoList($idDifunto)
    {
        $result = mysql_query("SELECT u.*, ua.`activo` as 'autorizado', ua.`fechaCreacion` as 'fechaAutorizacion', ua.`idUsuarioAutorizado`
                                FROM `usuario` u INNER JOIN `usuarioautorizado` ua ON u.`idUsuario` = ua.`idUsuario`
                                WHERE ua.`idDifunto` = ".$idDifunto.";", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function autorizarUsuario($idAutorizarUsuario){

        $sqlPlaca = "UPDATE `usuarioautorizado` SET `activo` = true WHERE `idUsuarioAutorizado` = ".$idAutorizarUsuario.";";

        if (mysql_query($sqlPlaca, $this->conexion)){
            return "true";
        }
        else {
            return "false";
        }
    }

    public function registrarUsuario($nombre, $apellido, $email,$idDifunto, $tipoUsuario)
    {
        $userName = strtolower($nombre[0])."".str_replace(" ","",strtolower($apellido)).rand(0, 999);
        $password ="".rand(1000, 9999);

        $sql = "INSERT INTO `usuario` (`nombre`, `apellido`, `userName`, `password`, `rol`, `email`, `activo`, `borrado`, `fechaCreacion`)
                VALUES ('".$nombre."', '".$apellido."', '".$userName."','".$password."','".$tipoUsuario."','".$email."', true, false, now())";

        if (mysql_query($sql, $this->conexion)){

            $idUsuario = mysql_insert_id();

            $sqlAutorizarUsuario = "INSERT INTO `usuarioautorizado` (`idUsuario`,`idDifunto`,`activo`,`borrado`,`fechaCreacion`) VALUES(".$idUsuario.",".$idDifunto.", 0, 0, now());";

            if (mysql_query($sqlAutorizarUsuario, $this->conexion)){

                $para  = $email;
                $título = 'Registro de Usuario App Funeraria';

                $mensaje = "<html>
                            <head>
                              <title>Registro de Usuario App Funeraria</title>
                            </head>
                            <body>
                              <p>¡Estos son sus datos de acceso!</p>
                              <table>
                                <tr>
                                  <th>Nombre</th><th>Usuario</th><th>Contraseña</th>
                                </tr>
                                <tr>
                                  <td>".$nombre."</td><td>".$userName."</td><td>".$password."</td>
                                </tr>                                
                              </table>
                            </body>
                            </html>";

                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


                $cabeceras .= 'To: '.$nombre.' '.$email. " \r\n";
                $cabeceras .= 'From: AppFuneraria' . "\r\n";

                mail($para, $título, $mensaje, $cabeceras);

                return "true";

            }else{
                return "false";
            }
        }
        else {
            return "false";
        }
    }

    public function getLogo()
    {
        $result = mysql_query("SELECT *
                               FROM `logo`
                               WHERE `nombre` = 'logo' limit 1;", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function getServiciosPorTipoDeServicioList($idTipoServicio)
    {
        $result = mysql_query("SELECT * FROM `servicio` WHERE `idTipoServicio` = ".$idTipoServicio.";", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function comprarServicio($idServicio, $idUsuario, $idDifunto)
    {
        $sql = "INSERT INTO `serviciocomprado` (`idServicio`,`idUsuario`,`idDifunto`,`activo`,`borrado`,`fechaCreacion`) VALUES(".$idServicio.", ".$idUsuario.", ".$idDifunto.", true, false, now())";

        if (mysql_query($sql, $this->conexion)){
            $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 1 WHERE `idDifunto` = ".$idDifunto.");";
            mysql_query($sqlUpdateIns, $this->conexion);
            return "true";
        }
        else {
            return "false";
        }
    }

    public function getDifuntosPorUsuarioList($idUsuario)
    {
        $result = mysql_query("SELECT d.* FROM `difunto` d INNER JOIN `usuarioautorizado` ua ON d.`idDifunto` = ua.`idDifunto` WHERE ua.`idUsuario` = ".$idUsuario.";", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function comprarMensaje($idUsuario, $idDifunto, $mensajePersonal)
    {
        $idServicio = 0;
        $sqlEsquela = "INSERT INTO `servicio` (`idTipoServicio`, `nombre`, `texto`, `activo`, `borrado`, `fechaCreacion`) VALUES(8,'Mensaje personalizado por el usuario ".$idUsuario."','".$mensajePersonal."',true,false,now());";
        if (mysql_query($sqlEsquela, $this->conexion)){
            $idServicio = mysql_insert_id();
        }
        
        $sql = "INSERT INTO `serviciocomprado` (`idServicio`,`idUsuario`,`idDifunto`,`activo`,`borrado`,`fechaCreacion`) VALUES(".$idServicio.", ".$idUsuario.", ".$idDifunto.", true, false, now())";

        if (mysql_query($sql, $this->conexion)){
            $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 1 WHERE `idDifunto` = ".$idDifunto.");";
            mysql_query($sqlUpdateIns, $this->conexion);
            return "true";
        }
        else {
            return "false";
        }
    }

    public function buscarDifuntosPorNombreOApellido($textoBusqueda)
    {
        $multipleValues = explode(" ", $textoBusqueda);

        if(sizeof($multipleValues)>1){
            $result = mysql_query("SELECT * FROM `difunto` WHERE `nombre` like '%".$multipleValues[0]."%' AND `apellidos` like '%".$multipleValues[1]."%';", $this->conexion);
        }else{
            $result = mysql_query("SELECT * FROM `difunto` WHERE `nombre` like '%".$textoBusqueda."%' OR `apellidos` like '%".$textoBusqueda."%';", $this->conexion);
        }
        
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            return json_encode($rows);
        }
    }

    public function solicitarAccesoDifunto($idUsuario, $idDifunto)
    {
        $result = mysql_query("SELECT 1 FROM `usuarioautorizado` WHERE `idUsuario` = ".$idUsuario." AND `idDifunto` = ".$idDifunto.";");
        $df = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $df = $row[1];
        }

        if ($df == 1){
            return "AccesoDado";
        }else{
            $sqlAutorizarUsuario = "INSERT INTO `usuarioautorizado` (`idUsuario`,`idDifunto`,`activo`,`borrado`,`fechaCreacion`) VALUES(".$idUsuario.",".$idDifunto.", 1, 0, now());";
            if (mysql_query($sqlAutorizarUsuario, $this->conexion)){
                return "true";
            }
            else {
                return "false";
            }
        }
        
    }

    public function borrarImagenDifunto($idDifunto, $idImagen)
    {
        $sqlBorrarImagen = "DELETE FROM `imagenesdifunto` WHERE `idDifunto` = ".$idDifunto." AND `idImagen` = ".$idImagen.";";

        if (mysql_query($sqlBorrarImagen, $this->conexion)){
            $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 1 WHERE `idDifunto` = ".$idDifunto.";";
            mysql_query($sqlUpdateIns, $this->conexion);
            return "true";
        }
        else {
            return "false";
        }
    }

    public function borrarUsuarioDifunto($idUsuarioAutorizado)
    {
        $sqlBorrar = "DELETE FROM `usuarioautorizado` WHERE `idUsuarioAutorizado` =".$idUsuarioAutorizado.";";

        if (mysql_query($sqlBorrar, $this->conexion)){

            return "true";
        }
        else {
            return "false";
        }
    }

    public function getServiciosPorIdDifuntoFloresYVelas($idDifunto)
    {
        $result = mysql_query("SELECT s.*,u.`nombre` as 'nombreUsuario', u.`apellido` as 'apellidoUsuario', sc.`fechaCreacion` as 'fechaCompra' 
                            FROM `servicio` s 
                            INNER JOIN `serviciocomprado` sc ON s.`idServicio` = sc.`idServicio`
                            INNER JOIN `usuario` u ON sc.`idUsuario` = u.`idUsuario`
                            WHERE s.`activo` = true AND sc.`activo` = true AND s.`idTipoServicio` in (4,3) AND sc.`idDifunto` = ".$idDifunto.";", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $rows = array();
            while ($row = mysql_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysql_free_result($result);

            $sqlUpdateIns = "UPDATE `inscripcion` SET `download` = 0 WHERE `idDifunto` = ".$idDifunto.";";
            mysql_query($sqlUpdateIns, $this->conexion);

            return json_encode($rows);
        }
    }

    public function placaInformationNeedDownload($idDifunto)
    {
        $result = mysql_query("SELECT i.`download` FROM `inscripcion` i WHERE i.`idDifunto` = ".$idDifunto." LIMIT 1;", $this->conexion);        
        $result = mysql_result($result,0);

        if ($result){
            return "true";
        }else{
            return "false";
        }
    }

    public function registroUsuario($nombre, $apellido, $email,$idDifunto, $tipoUsuario)
    {
        $userName = strtolower($nombre[0])."".str_replace(" ","",strtolower($apellido)).rand(0, 999);
        $password ="".rand(1000, 9999);

        $sql = "INSERT INTO `usuario` (`nombre`, `apellido`, `userName`, `password`, `rol`, `email`, `activo`, `borrado`, `fechaCreacion`)
                VALUES ('".$nombre."', '".$apellido."', '".$userName."','".$password."','".$tipoUsuario."','".$email."', true, false, now())";

        if (mysql_query($sql, $this->conexion)){

            $idUsuario = mysql_insert_id();

            if($idDifunto != 0){
                $sqlAutorizarUsuario = "INSERT INTO `usuarioautorizado` (`idUsuario`,`idDifunto`,`activo`,`borrado`,`fechaCreacion`) VALUES(".$idUsuario.",".$idDifunto.", 0, 0, now());";
                mysql_query($sqlAutorizarUsuario, $this->conexion);
            }

            $db = new BaseDatos();

            if($db->conectar()){
                $list = $db->userInformation($userName);
                $db->desconectar();
                return $list;
            }
        }
        else {
            return "";
        }
    }
}

	
