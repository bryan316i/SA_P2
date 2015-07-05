<?php 
	require_once('lib/nusoap.php');

	$wsdl = "http://192.168.1.31:8080/SA_Proyecto_Servidor/nuevoUsuario?wsdl";

	$client = new nusoap_client($wsdl, 'wsdl');

	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2>' . $err;
		exit();
	}
	$result1=$client->call('obtenerCuentasUsuario', array('id_usuario'=>'viktorcoradov@outlook.com'));
	print_r($result1);
	$cadena = array();
	split('&', $cadena);
	echo '</br>';
	print_r($cadena);
?>
