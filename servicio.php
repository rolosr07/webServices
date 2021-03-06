<?php

	require_once "dbconexion.php";

	function getServiciosList() {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getServiciosList();
			$db->desconectar();
			return $list;

		}
	}

	function getRestosList() {
	
		$db = new BaseDatos();
	
		if($db->conectar()){
			$list = $db->getRestosList();
			$db->desconectar();
			return $list;
	
		}
	}

	function registrarPlaca($idDifunto, $idImagenSuperior, $idOrla, $idEsquela, $idRestos, $esquelaPersonal) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->registrarInscripcion($idDifunto, $idImagenSuperior, $idOrla, $idEsquela, $idRestos, $esquelaPersonal);
			$db->desconectar();
			return $list;
		}
	}

	function getPlacaInformation($idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getPlacaInformation($idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	function getServiciosPorIdDifuntoYTipoDeServicioList($idDifunto, $idTipoServicio) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getServiciosPorIdDifuntoYTipoDeServicioList($idDifunto, $idTipoServicio);
			$db->desconectar();
			return $list;
		}
	}

	function getServiciosPorIdDifuntoYTipoDeServicioMensajesList($idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getServiciosPorIdDifuntoYTipoDeServicioMensajesList($idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	function actualizarServicioComprado($idServicioComprado, $estado) {
	
		$db = new BaseDatos();
	
		if($db->conectar()){
			$list = $db->actualizarServicioComprado($idServicioComprado, $estado);
			$db->desconectar();
			return $list;
		}
	}

	function getServiciosPorTipoDeServicioList($idTipoServicio) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getServiciosPorTipoDeServicioList($idTipoServicio);
			$db->desconectar();
			return $list;
		}
	}

	function comprarServicio($idServicio, $idUsuario, $idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->comprarServicio($idServicio, $idUsuario, $idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	function comprarMensaje($idUsuario, $idDifunto, $mensajePersonal) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->comprarMensaje($idUsuario, $idDifunto, $mensajePersonal);
			$db->desconectar();
			return $list;
		}
	}

	function getServiciosPorIdDifuntoFloresYVelas($idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getServiciosPorIdDifuntoFloresYVelas($idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	function placaInformationNeedDownload($idDifunto) {
	
		$db = new BaseDatos();
	
		if($db->conectar()){
			$list = $db->placaInformationNeedDownload($idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	require_once "nusoap.php";

    $server = new soap_server();

	$myNamespace = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

	$server->configureWSDL('ServicesServiceReference', 'urn:'.$myNamespace);

	$server->register('getServiciosList',
		array(),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getDifuntosList",
		'rpc',
		'encoded',
		'getDifuntosList.'
	);

	$server->register('getRestosList',
		array(),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getRestosList",
		'rpc',
		'encoded',
		'getRestosList.'
	);

	$server->register('registrarPlaca',
		array('idDifunto' => 'xsd:int', 'idImagenSuperior' => 'xsd:int', 'idOrla' => 'xsd:int', 'idEsquela' => 'xsd:int', 'idRestos' => 'xsd:int', 'esquelaPersonal' => 'xsd:string'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#registrarInscripcion",
		'rpc',
		'encoded',
		'registrarInscripcion.'
	);

	$server->register('getPlacaInformation',
		array('idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getPlacaInformation",
		'rpc',
		'encoded',
		'getPlacaInformation.'
	);

	$server->register('getServiciosPorIdDifuntoYTipoDeServicioList',
		array('idDifunto' => 'xsd:int','idTipoServicio' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getServiciosPorIdDifuntoYTipoDeServicioList",
		'rpc',
		'encoded',
		'getServiciosPorIdDifuntoYTipoDeServicioList.'
	);

	$server->register('getServiciosPorIdDifuntoYTipoDeServicioMensajesList',
		array('idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getServiciosPorIdDifuntoYTipoDeServicioMensajesList",
		'rpc',
		'encoded',
		'getServiciosPorIdDifuntoYTipoDeServicioMensajesList.'
	);

	$server->register('actualizarServicioComprado',
		array('idServicioComprado' => 'xsd:int', 'estado' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#actualizarServicioComprado",
		'rpc',
		'encoded',
		'actualizarServicioComprado.'
	);

	$server->register('getServiciosPorTipoDeServicioList',
		array('idTipoServicio' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getServiciosPorTipoDeServicioList",
		'rpc',
		'encoded',
		'getServiciosPorTipoDeServicioList.'
	);

	$server->register('comprarServicio',
		array('idServicio' => 'xsd:int','idUsuario' => 'xsd:int','idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#comprarServicio",
		'rpc',
		'encoded',
		'comprarServicio.'
	);

	$server->register('comprarMensaje',
		array('idUsuario' => 'xsd:int','idDifunto' => 'xsd:int','mensajePersonal' => 'xsd:string'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#comprarMensaje",
		'rpc',
		'encoded',
		'comprarMensaje.'
	);

	$server->register('getServiciosPorIdDifuntoFloresYVelas',
		array('idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#getServiciosPorIdDifuntoFloresYVelas",
		'rpc',
		'encoded',
		'getServiciosPorIdDifuntoFloresYVelas.'
	);

	$server->register('placaInformationNeedDownload',
		array('idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#placaInformationNeedDownload",
		'rpc',
		'encoded',
		'placaInformationNeedDownload.'
	);

	#$server->wsdl->schemaTargetNamespace = $myNamespace;
    $server->service(isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '');

	exit();
