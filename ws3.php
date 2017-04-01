<?php

    function getStuffs( $user='', $pass='' ) {
        // here we can check user and pass and do whatever (if it isn't alright, we can throw exception or return NULL or sg. similar)
        // .......

        $stuff_array   = array();
        $stuff_array[] = array( 'id'=>122, 'name'=>'One stuff');
        $stuff_array[] = array( 'id'=>213, 'name'=>'Another stuff');
        $stuff_array[] = array( 'id'=>435, 'name'=>'Whatever stuff');
        $stuff_array[] = array( 'id'=>65, 'name'=>'Cool Stuff');
        $stuff_array[] = array( 'id'=>92, 'name'=>'Wow, what a stuff');    

        return $stuff_array;
    }

    require_once 'nusoap.php';
    $server = new soap_server;

    // $myNamespace = $_SERVER['SCRIPT_URI'];
    $myNamespace = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

    $server->configureWSDL('MyStuffService', 'urn:' . $myNamespace);
    // $server->wsdl->schemaTargetNamespace = 'http://soapinterop.org/xsd/';

    $server->wsdl->addComplexType(
        // name
        'Stuffs',
        // typeClass (complexType|simpleType|attribute)
        'complexType',
        // phpType: currently supported are array and struct (php assoc array)
        'struct',
        // compositor (all|sequence|choice)
        'all',
        // restrictionBase namespace:name (http://schemas.xmlsoap.org/soap/encoding/:Array)
        '',
        // elements = array ( name = array(name=>'',type=>'') )
        array(
            'id' => array(
                'name' => 'id',
                'type' => 'xsd:int'
            ),
            'name' => array(
                'name' => 'name',
                'type' => 'xsd:string'
            )
        )
    );  

    $server->wsdl->addComplexType(
        // name
        'StuffsArray',
        // typeClass (complexType|simpleType|attribute)
        'complexType',
        // phpType: currently supported are array and struct (php assoc array)
        'array',
        // compositor (all|sequence|choice)
        '',
        // restrictionBase namespace:name (http://schemas.xmlsoap.org/soap/encoding/:Array)
        'SOAP-ENC:Array',
        // elements = array ( name = array(name=>'',type=>'') )
        array(),
        // attrs
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:Stuffs[]'
            )
        ),
        // arrayType: namespace:name (http://www.w3.org/2001/XMLSchema:string)
        'tns:Stuffs'
    );

    $server->register(
        // string $name the name of the PHP function, class.method or class..method
        'getStuffs',
        // array $in assoc array of input values: key = param name, value = param type
        array(
            'user' => 'xsd:string',
            'pass' => 'xsd:string'
        ),
        // array $out assoc array of output values: key = param name, value = param type
        array(
            'return' => 'tns:StuffsArray'
        ),
        // mixed $namespace the element namespace for the method or false
        'urn:' . $myNamespace,
        // mixed $soapaction the soapaction for the method or false
        'urn:' . $myNamespace . "#getStuffs",
        // mixed $style optional (rpc|document) or false Note: when 'document' is specified, parameter and return wrappers are created for you automatically
        'rpc',
        // mixed $use optional (encoded|literal) or false
        'encoded',
        // string $documentation optional Description to include in WSDL
        'Fetch array of Stuffs ("id", "name").' // documentation
    );

    #$server->wsdl->schemaTargetNamespace = $myNamespace;
    $server->service(isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '');
    exit();

?>