<?php
//call library 
require_once ('lib/nusoap.php'); 
//using soap_server to create server object 
$URL = "http://localhost/SA_WebService/server.php";
$namespace = 'urn:server';
$server = new soap_server; 

$server->configureWSDL('get_message', $namespace);
$server->wsdl->schemaTargetNamespace = 'urn:server';

//register a function that works on server
$server->register("get_message",array("name" => "string"),array("return" => "string"),"urn:helloworld","urn:helloworld#get_message");


$server->wsdl->addComplexType(
    'Person',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id_user' => array('name' => 'id_user', 'type' => 'xsd:int'),
        'fullname' => array('name' => 'fullname', 'type' => 'xsd:string'),
        'email' => array('name' => 'email', 'type' => 'xsd:string'),
        'level' => array('name' => 'level', 'type' => 'xsd:int')
    )
);

//first simple function
$server->register('hello',
			array('username' => 'xsd:string'),  //parameter
			array('return' => 'xsd:string'),  //output
			'urn:server',   //namespace
			'urn:server#helloServer',  //soapaction
			'rpc', // style
			'encoded', // use
			'Just say hello');  //description

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
function hello($username) {
        return 'Howdy, '.$username.'!';
}

//second function implementation 
function login($username, $password) {
        //should do some database query here
        // .... ..... ..... .....
        //just some dummy result
        return array(
		'id_user'=>1,
		'fullname'=>'John Reese',
		'email'=>'john@reese.com',
		'level'=>99
	);
}


// create the function 
function get_message($your_name) 
{ 
if(!$your_name){ 
return new soap_fault('Client','','Put Your Name!'); 
} 
$result = "Welcome to ".$your_name .". Thanks for Your First Web Service Using PHP with SOAP"; 
return $result; 
} 
// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA); 
exit(); 
?>  
