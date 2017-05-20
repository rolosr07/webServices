<?php
	require_once "dbconexion.php";
      
	function login($userName, $password) {

		$db = new BaseDatos();

		if($db->conectar()){

			if ($db->login($userName, $password)) {

				$userInformation = $db->userInformation($userName);				
				$db->desconectar();
				return $userInformation;
			}
			else {
				$db->desconectar();
				return "";
			}
		}
	}

	function registerUser($nombre, $apellido, $userName, $password, $email, $rol) {

		$db = new BaseDatos();

		if($db->conectar()){

			if ($db->registerUser($nombre, $apellido, $userName, $password, $email, $rol)) {
				$db->desconectar();
				return true;
			}
			else {
				$db->desconectar();
				return false;
			}
		}		
	}

	function updateUser($idUsuario, $nombre, $apellido, $userName, $password, $email, $rol) {
	
		$db = new BaseDatos();
	
		if($db->conectar()){
	
			if ($db->updateUser($idUsuario, $nombre, $apellido, $userName, $password, $email, $rol)) {
				$db->desconectar();
				return "true";
			}
			else {
				$db->desconectar();
				return "false";
			}
		}
		
	}

	function getUsuariosAutorizadosDifuntoList($idDifunto) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getUsuariosAutorizadosDifuntoList($idDifunto);
			$db->desconectar();
			return $list;
		}
	}

	function autorizarUsuario($idAutorizarUsuario) {

		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->autorizarUsuario($idAutorizarUsuario);
			$db->desconectar();
			return $list;
		}
	}

	function registrarUsuario($nombre, $apellido, $email, $idDifunto, $tipoUsuario) {
	
		$db = new BaseDatos();
	
		if($db->conectar()){
	
			if ($db->registrarUsuario($nombre, $apellido, $email, $idDifunto, $tipoUsuario)) {
				$db->desconectar();
				return "true";
			}
			else {
				$db->desconectar();
				return "false";
			}
		}
	}

	function registroUsuario($nombre, $apellido, $email, $idDifunto, $tipoUsuario) {
	
		$db = new BaseDatos();
		$list = "";
		if($db->conectar()){
			$list = $db->registroUsuario($nombre, $apellido, $email, $idDifunto, $tipoUsuario) ;
			$db->desconectar();			
		}
		return $list;
	}

	function loadLogo() {
	
		$db = new BaseDatos();

		if($db->conectar()){
			$list = $db->getLogo();
			$db->desconectar();
			return $list;
		}
	}

	require_once "nusoap.php";

    $server = new soap_server();

	$myNamespace = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

	$server->configureWSDL('UserServiceReference', 'urn:'.$myNamespace);

	$server->register('login',
		array('userName' => 'xsd:string','password' => 'xsd:string'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#login",

		'rpc',

		'encoded',

		'Login and return user information.'
	);

	$server->register('registerUser',
		array('nombre' => 'xsd:string','apellido' => 'xsd:string','userName' => 'xsd:string','password' => 'xsd:string','email' => 'xsd:string','rol' => 'xsd:string'),
		array('return' => 'xsd:bool'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#registerUser",

		'rpc',

		'encoded',

		'Register User.'
	);

	$server->register('updateUser',
		array('idUsuario' => 'xsd:string','nombre' => 'xsd:string','apellido' => 'xsd:string','userName' => 'xsd:string','password' => 'xsd:string','email' => 'xsd:string','rol' => 'xsd:string'),
		array('return' => 'xsd:bool'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#updateUser",

		'rpc',

		'encoded',

		'Update User.'
	);

	$server->register('getUsuariosAutorizadosDifuntoList',
		array('idDifunto' => 'xsd:int'),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#getUsuariosAutorizadosDifuntoList",

		'rpc',

		'encoded',

		'getUsuariosAutorizadosDifuntoList.'
	);

	$server->register('autorizarUsuario',
		array('idAutorizarUsuario' => 'xsd:int'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#autorizarUsuario",
		'rpc',
		'encoded',
		'autorizarUsuario.'
	);

	$server->register('registrarUsuario',
		array('nombre' => 'xsd:string','apellido' => 'xsd:string','email' => 'xsd:string','idDifunto' => 'xsd:int','tipoUsuario' => 'xsd:string'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#registrarUsuario",
		'rpc',
		'encoded',
		'registrarUsuario.'
	);

	$server->register('loadLogo',
		array(),
		array('return' => 'xsd:string'),

		'urn:' . $myNamespace,

		'urn:' . $myNamespace . "#loadLogo",

		'rpc',

		'encoded',

		'loadLogo.'
	);

	$server->register('registroUsuario',
		array('nombre' => 'xsd:string','apellido' => 'xsd:string','email' => 'xsd:string','idDifunto' => 'xsd:int','tipoUsuario' => 'xsd:string'),
		array('return' => 'xsd:string'),
		'urn:' . $myNamespace,
		'urn:' . $myNamespace . "#registroUsuario",
		'rpc',
		'encoded',
		'registroUsuario.'
	);

	#$server->wsdl->schemaTargetNamespace = $myNamespace;
    $server->service(isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '');
	exit();
