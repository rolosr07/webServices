<?php

	require_once "dbconexion.php";

	function registrarDifunto($idUsuario, $idDifunto, $nombre, $apellido, $fechaNacimiento, $fechaDeceso) {

		$db = new BaseDatos();

		if($db->conectar()){
			if ($db->registrarDifunto($idUsuario, $idDifunto, $nombre, $apellido, $fechaNacimiento, $fechaDeceso)) {
				$db->desconectar();
				return "true";
			}
			else {
				$db->desconectar();
				return "false";
			}
		}		
	}

	function getDifuntosList() {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getDifuntosList();
			$db->desconectar();
			return $list;

		}
	}

	function getImagenesDifuntoList($idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getImagenesDifuntoList($idDifunto);
			$db->desconectar();
			return $list;

		}
	}

	function registrarImagenDifunto($idDifunto, $nombreImagen, $imagen, $tipoImagen) {
	
		$db = new BaseDatos();
	
		if($db->conectar()){
			$result = $db->registrarImagenDifunto($idDifunto, $nombreImagen, $imagen, $tipoImagen);
			$db->desconectar();
			return $result;
	
		}
	}

	function getDifuntosPorUsuarioList($idUsuario) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getDifuntosPorUsuarioList($idUsuario);
			$db->desconectar();
			return $list;
		}
	}

	function buscarDifuntosPorNombreOApellido($textoBusqueda) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->buscarDifuntosPorNombreOApellido($textoBusqueda);
			$db->desconectar();
			return $list;
		}
	}

	function solicitarAccesoDifunto($idUsuario, $idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->solicitarAccesoDifunto($idUsuario, $idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	function borrarImagenDifunto($idDifunto, $idImagen) {
		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->borrarImagenDifunto($idDifunto, $idImagen);
			$db->desconectar();
			return $list;
		}
	}

	function borrarUsuarioDifunto($idUsuarioAutorizado) {
		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->borrarUsuarioDifunto($idUsuarioAutorizado);
			$db->desconectar();
			return $list;
		}
	}

	require_once "nusoap.php";
    $server = new soap_server();

	$myNamespace = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

	$server->configureWSDL('UserServiceReference', 'urn:'.$myNamespace);

	$server->register('registrarDifunto',
		array('idUsuario'=> 'xsd:int', 'idDifunto'=> 'xsd:int', 'nombre' => 'xsd:string','apellido' => 'xsd:string','fechaNacimiento' => 'xsd:string','fechaDeceso' => 'xsd:string'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#registrarDifunto",

		'rpc',

		'encoded',

		'Registrar Difunto.'
	);

	$server->register('getDifuntosList',
		array('nombre' => 'xsd:string'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#getDifuntosList",

		'rpc',

		'encoded',

		'getDifuntosList.'
	);

	$server->register('getImagenesDifuntoList',
		array('idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#getImagenesDifuntoList",

		'rpc',

		'encoded',

		'getImagenesDifuntoList.'
	);

	$server->register('registrarImagenDifunto',
		array('idDifunto' => 'xsd:int','nombreImagen' => 'xsd:string','imagen' => 'xsd:string','tipoImagen' => 'xsd:string'),
		array('return' => 'xsd:string'),
	
		'urn:' . $myNamespace,
	
		'urn:' . $myNamespace . "#registrarImagenDifunto",
	
		'rpc',
	
		'encoded',
	
		'registrarImagenDifunto.'
	);

	$server->register('getDifuntosPorUsuarioList',
		array('idUsuario' => 'xsd:int'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#getDifuntosPorUsuarioList",

		'rpc',

		'encoded',

		'getDifuntosPorUsuarioList.'
	);

	$server->register('buscarDifuntosPorNombreOApellido',
		array('textoBusqueda' => 'xsd:string'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#buscarDifuntosPorNombreOApellido",

		'rpc',

		'encoded',

		'buscarDifuntosPorNombreOApellido.'
	);

	$server->register('solicitarAccesoDifunto',
		array('idUsuario' => 'xsd:int','idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#solicitarAccesoDifunto",

		'rpc',

		'encoded',

		'solicitarAccesoDifunto.'
	);

	$server->register('borrarImagenDifunto',
		array('idDifunto' => 'xsd:int','idImagen' => 'xsd:int'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#borrarImagenDifunto",

		'rpc',

		'encoded',

		'borrarImagenDifunto.'
	);

	$server->register('borrarUsuarioDifunto',
		array('idUsuarioAutorizado' => 'xsd:int'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#borrarUsuarioDifunto",

		'rpc',

		'encoded',

		'borrarUsuarioDifunto.'
	);

	#$server->wsdl->schemaTargetNamespace = $myNamespace;
	$server->service(file_get_contents("php://input"));

	exit();
