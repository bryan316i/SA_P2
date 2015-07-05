<?php 
	require_once('lib/nusoap.php');

	$wsdl = "http://192.168.1.15:8080/prestamos.asmx?wsdl";
	//$wsdl = "http://192.168.1.10:8099/Finanzas.asmx?wsdl";
	$client = new nusoap_client($wsdl, 'wsdl');

	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2>' . $err;
		exit();
	}
	//$result1=$client->call('crear_prestamo', array('monto'=>'15000', 'interes'=>'10', 'num_cuotas'=>'24', 'cliente'=>'41'));	
	$result1=$client->call('IniciarSesion', array('usuario'=>'usuario12', 'contrasenia'=>'usuario12'));
	//$result1=$client->call('prueba', array('Nombre'=>'php'));
	print_r($result1);
	echo '</br>';


echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';


echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';

?>
