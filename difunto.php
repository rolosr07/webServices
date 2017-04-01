<?php

	require_once "dbconexion.php";

	function registrarDifunto($nombre, $apellido,$fechaNacimiento, $fechaDeceso) {

		$db = new BaseDatos();

		if($db->conectar()){
			if ($db->registrarDifunto($nombre, $apellido,$fechaNacimiento, $fechaDeceso)) {
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

	require_once "nusoap.php";
    $server = new soap_server();

	$myNamespace = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

	$server->configureWSDL('UserServiceReference', 'urn:'.$myNamespace);

	$server->register('registrarDifunto',
		array('nombre' => 'xsd:string','apellido' => 'xsd:string','fechaNacimiento' => 'xsd:string','fechaDeceso' => 'xsd:string'),
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

	#$server->wsdl->schemaTargetNamespace = $myNamespace;
	$server->service(file_get_contents("php://input"));

	exit();
