<?php
//call library 
require_once ('lib/nusoap.php'); 

//using soap_server to create server object 
//$URL = "http://localhost/SA_WebService/docsid.php";
//$namespace = $URL . '?wsdl';
$server = new soap_server; 

//$server->configureWSDL('get_docsid', $namespace);

$server->register('get_docsid'); 
//register a function that works on server
//$server->register("get_docsid",array("name" => "string"),array("return" => "string"),"urn:helloworld","urn:helloworld#get_message");

// create the function 
function get_docsid() 
{ 

$conn = oci_connect('sa', 'sa123', '192.168.1.50');

$stid = oci_parse($conn, 'select idDocumentoIdentificacion from documentoidentificacion');

oci_execute($stid);
;

while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
	$result = $result . "<idsDocumentoIdentificacion>";
	foreach ($row as $item) {
		$result = $result . "<idDocumentoIdentificacion>".($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</idDocumentoIdentificacion>";
	}
	$result = $result . "</idsDocumentoIdentificacion>";
}

return $result; 
} 
// create HTTP listener 
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA); 
exit(); 
?>  
