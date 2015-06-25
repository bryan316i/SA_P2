<?php 
require_once('lib/nusoap.php');

//This is your webservice server WSDL URL address
$wsdl = "http://localhost/SA_WebServices/server.php?wsdl";

//create client object
$client = new nusoap_client($wsdl, 'wsdl');

$err = $client->getError();
if ($err) {
	// Display the error
	echo '<h2>Constructor error</h2>' . $err;
	// At this point, you know the call that follows will fail
        exit();
}

//calling our first simple entry point
$result1=$client->call('getIdsDocumentoIdentificacion');
print_r($result1); 

?>
