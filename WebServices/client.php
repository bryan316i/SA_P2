<?php 
	require_once('lib/nusoap.php');

	$wsdl = "http://localhost/WebServices/server.php?wsdl";

	$client = new nusoap_client($wsdl, 'wsdl');

	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2>' . $err;
		exit();
	}


	/*$result1=$client->call('getIdsDocumentoIdentificacion');
	print_r($result1); 
	echo '</br>';

	$result1=$client->call('getDocumentoIdentificacion', array('id'=>1));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getIdsTipoPrestamo');
	print_r($result1);  
	echo '</br>';

	$result1=$client->call('getTipoPrestamo', array('id'=>1));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getIdsTipoSeguro');
	print_r($result1);  
	echo '</br>';

	$result1=$client->call('getTipoSeguro', array('id'=>1));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getIdsBanco');
	print_r($result1);  
	echo '</br>';

	$result1=$client->call('getBanco', array('id'=>1));
	print_r($result1);
	echo '</br>';
	
	$result1=$client->call('addUser', array('nombre'=>'Cristian', 'apellido'=>'Mucun', 'telefono'=>51188496, 'direccion'=>'City', 'idDocIdentificacion'=>1, 'numDocIdentificacion'=>'1234', 'email'=>'c@m.com'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('login', array('usuario'=>'usuario2', 'password'=>'pass2'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('logout', array('usuario'=>'usuario2'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getInfoUsuario', array('usuario'=>'usuario2'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('setPassword', array('usuario'=>'usuario2', 'password'=>'pass2'));
	print_r($result1);
	echo '</br>';
	
	$result1=$client->call('getIdsCuenta', array('id'=>5, 'usuario'=>'usuario5'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getCuenta', array('id'=>5, 'usuario'=>'usuario2'));
	print_r($result1);
	echo '</br>';

	/*$result1=$client->call('addMovimientoLocal', array('id'=>5, 'usuario'=>'usuario2', 'tipoOperacion'=>1, 'monto'=>10000));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('addTransferenciaLocal', array('id'=>5, 'usuario'=>'usuario2', 'idCuentaSecundaria'=>21, 'tipoOperacion'=>2, 'monto'=>1000));
	print_r($result1);
	echo '</br>';
	
	$result1=$client->call('getIdsMovimiento', array('id'=>5, 'usuario'=>'usuario2'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getMovimiento', array('idCuenta'=>5, 'idMovimiento'=>3));
	print_r($result1);
	echo '</br>';	

	$result1=$client->call('getIdsPrestamoCuenta', array('id'=>5, 'usuario'=>'usuario2'));
	print_r($result1);
	echo '</br>';


	$result1=$client->call('getPrestamo', array('idPrestamo'=>11));
	print_r($result1);
	echo '</br>';


echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';


echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';


	$result1=$client->call('getIdsPrestamoSinAutorizar');
	print_r($result1);  
	echo '</br>';

	$result1=$client->call('setAutorizarPrestamo', array('id'=>2));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getIdsSeguroCuenta', array('id'=>5, 'usuario'=>'usuario2'));
	print_r($result1);
	echo '</br>';

	$result1=$client->call('getSeguro', array('idCuenta'=>5, 'idSeguro'=>2));
	print_r($result1);
	echo '</br>';*/

	
	$result1=$client->call('addTransferenciaExterna', array('idCuenta'=>5,'idCuentaExterna'=>41,'tipoOperacion'=>2,'monto'=>1000,'nombreBanco'=>'ASP'));
	print_r($result1);
	echo '</br>';
?>
