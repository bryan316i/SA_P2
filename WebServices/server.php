<?php
require_once ('lib/nusoap.php');
require 'confBD.php';

$server = new nusoap_server;
$server->configureWSDL('server', 'urn:server');
$server->wsdl->schemaTargetNamespace = 'urn:server';


$server->wsdl->addComplexType(
    'IdsDocumentoIdentificacion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'cantidad' => array('name' => 'cantidad', 'type' => 'xsd:int'),
        'ids' => array('name' => 'array', 'type' => 'xsd:int[]')
    )
);



//first simple function
$server->register('getIdsDocumentoIdentificacion',
			array(),  //parameter
			array('return' => 'tns:IdsDocumentoIdentificacion'),  //output
			'urn:server',   //namespace
			'urn:server#getIdsDocumentoIdentificacionServer',  //soapaction
			'rpc', // style
			'encoded', // use
			'Devuelve IDS de los tipos de documento de identificacion');  //description

//this is the second webservice entry point/function 
$server->register('login',
			array('username' => 'xsd:string', 'password'=>'xsd:string'),  //parameters
			array('return' => 'tns:Person'),  //output
			'urn:server',   //namespace
			'urn:server#loginServer',  //soapaction
			'rpc', // style
			'encoded', // use
			'Check user login');  //description

//first function implementation
function getIdsDocumentoIdentificacion() {
	require 'confBD.php';

	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'select * from documentoidentificacion');
	oci_execute($stid);
;
	$idsdocs = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDDOCUMENTOIDENTIFICACION'] !== null){
			$total++;
			$idsdocs[] = $row['IDDOCUMENTOIDENTIFICACION'];
		}
	}

	return array('cantidad'=>$total, 'ids'=>$idsdocs);
}

//second function implementation 
function login($username, $password) {
        //should do some database query here
        // .... ..... ..... .....
        //just some dummy result
        return  array(
		'id_user'=>1,
		'fullname'=>'John Reese',
		'email'=>'john@reese.com',
		'level'=>99
	);

}



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);
exit();
?>
