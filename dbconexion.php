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
        $result = mysql_query("SELECT * from `usuario` where `userName`= '".$userName."' and `activo` = true;", $this->conexion);
        if ($result == 0)
            return "";
        else {

            $row = mysql_fetch_array($result);
            mysql_free_result($result);
            return join(",", array(
                $row['nombre'],
                $row['apellido'],
                $row['rol'],
                $row['email'],
                $row['activo'],
				$row['idUsuario'],
				$row['password'],
				$row['userName']));
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

    public function registrarDifunto($nombre, $apellido,$fechaNacimiento, $fechaDeceso)
    {
        $sql = "INSERT INTO `difunto` (`nombre`,`apellidos`,`fechaNacimiento`,`fechaDefuncion`,`activo`,`borrado`,`fechaCreacion`)
                VALUES('".$nombre."','".$apellido."','".$fechaNacimiento."','".$fechaDeceso."',true,false,now());";

        if (mysql_query($sql, $this->conexion))
            return true;
        else {
            return false;
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

    public function getPlacaInformation($idDifunto)
    {
        $result = mysql_query("SELECT d.`nombre`, d.`apellidos`, d.`fechaNacimiento`, d.`fechaDefuncion`,
                                sis.`imagen` as 'imagenSuperior',sio.`imagen` as 'imagenOrla',
                                sie.`texto` as 'esquela',
                                r.`nombre` as 'nombreLugarRestos',
                                r.`ubicacion` as 'ubicacionLugarRestos'
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
        $result = mysql_query("SELECT s.*,u.`nombre` as 'nombreUsuario', u.`apellido` as 'apellidoUsuario', sc.`fechaCreacion` as 'fechaCompra' FROM `servicio` s 
            INNER JOIN `tiposervicio` ts ON s.`idTipoServicio` = ts.`idTipoServicio`
            INNER JOIN `serviciocomprado` sc ON s.`idServicio` = sc.`idServicio`
            INNER JOIN `usuario` u ON sc.`idUsuario` = u.`idUsuario`
            INNER JOIN `usuarioautorizado` ua ON u.`idUsuario` = ua.`idUsuario`
            WHERE s.`activo` = true AND sc.`activo` = true AND ts.`idTipoServicio` = ".$idTipoServicio." AND ua.`idDifunto` = ".$idDifunto.";", $this->conexion);
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

    public function getServiciosPorIdDifuntoYTipoDeServicioMensajesList($idDifunto, $idTipoServicio)
    {
        $result = mysql_query("SELECT s.*,u.`nombre` as 'nombreUsuario', u.`apellido` as 'apellidoUsuario', sc.`fechaCreacion` as 'fechaCompra', sc.`activo` AS 'autorizado', sc.`idServicioComprado` FROM `servicio` s 
            INNER JOIN `tiposervicio` ts ON s.`idTipoServicio` = ts.`idTipoServicio`
            INNER JOIN `serviciocomprado` sc ON s.`idServicio` = sc.`idServicio`
            INNER JOIN `usuario` u ON sc.`idUsuario` = u.`idUsuario`
            INNER JOIN `usuarioautorizado` ua ON u.`idUsuario` = ua.`idUsuario`
            WHERE ts.`idTipoServicio` = ".$idTipoServicio." AND ua.`idDifunto` = ".$idDifunto.";", $this->conexion);
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

    public function actualizarServicioComprado($idServicioComprado){

        $sqlPlaca = "UPDATE `serviciocomprado` SET `activo` = true WHERE `idServicioComprado` = ".$idServicioComprado.";";

        if (mysql_query($sqlPlaca, $this->conexion)){
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
}

	
