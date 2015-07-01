<?php
require_once ('lib/nusoap.php');

$namespace = 'urn:server';
$server = new nusoap_server;
$server->configureWSDL('server', $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType('ArrayInt',
	'complexType',
	'array',
	'',
	'SOAP-ENC:Array',
	array(),
	array(
	array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'xsd:int[]')),
	'xsd:int');

$server->wsdl->addComplexType(
    'ListaIds',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'cantidad' => array('name' => 'cantidad', 'type' => 'xsd:int'),
        'array' => array('name' => 'array', 'type' => 'tns:ArrayInt')
    )
);

$server->wsdl->addComplexType(
    'DocumentoIdentificacion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'TipoPrestamo',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
        'min' => array('name' => 'min', 'type' => 'xsd:double'),
        'max' => array('name' => 'max', 'type' => 'xsd:double'),
        'tasaInteres' => array('name' => 'tasaInteres', 'type' => 'xsd:double'),
        'cantidadCuotas' => array('name' => 'cantidadCuotas', 'type' => 'xsd:int')
    )
);

$server->wsdl->addComplexType(
    'TipoSeguro',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string')
    )
);


$server->wsdl->addComplexType(
    'Banco',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'direccionIP' => array('name' => 'direccionIP', 'type' => 'xsd:string'),
        'puerto' => array('name' => 'puerto', 'type' => 'xsd:int')
    )
);

$server->wsdl->addComplexType(
    'UsuarioRegistro',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
        'mensaje' => array('name' => 'mensaje', 'type' => 'xsd:string'),
	'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
	'password' => array('name' => 'password', 'type'=>'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'Respuesta',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
        'mensaje' => array('name' => 'mensaje', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'Usuario',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
	'id' => array('name' => 'id', 'type' => 'xsd:int'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'apellido' => array('name' => 'apellido', 'type' => 'xsd:string'),
        'telefono' => array('name' => 'telefono', 'type' => 'xsd:int'),
        'direccion' => array('name' => 'direccion', 'type' => 'xsd:string'),
	'cambiarPass' => array('name' => 'cambiarPass', 'type' => 'xsd:int'),
        'fechaRegistro' => array('name' => 'fechaRegistro', 'type' => 'xsd:date'),
        'idDocIdentificacion' => array('name' => 'idDocIdentificacion', 'type' => 'xsd:int'),
        'numDocIdentificacion' => array('name' => 'numDocIdentificacion', 'type' => 'xsd:string'),
	'email' => array('name' => 'email', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'Cuenta',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'fechaCreacion' => array('name' => 'fechaCreacion', 'type' => 'xsd:date'),
        'saldo' => array('name' => 'saldo', 'type' => 'xsd:double')
    )
);

$server->wsdl->addComplexType(
    'CuentaNueva',
    'complexType',
    'struct',
    'all',
    '',
    array(
	'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
	'id' => array('name' => 'id', 'type' => 'xsd:int'),
        'fechaCreacion' => array('name' => 'fechaCreacion', 'type' => 'xsd:date')
    )
);

$server->wsdl->addComplexType(
    'MovimientoLocal',
    'complexType',
    'struct',
    'all',
    '',
    array(
	'resultado' => array('name' => 'resultado', 'type' => 'xsd:int'),
	'mensaje' => array('name' => 'mensaje', 'type' => 'xsd:string'),
        'saldo' => array('name' => 'saldo', 'type' => 'xsd:double')
    )
);

$server->wsdl->addComplexType(
    'Movimiento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'fecha' => array('name' => 'fecha', 'type' => 'xsd:date'),
        'monto' => array('name' => 'monto', 'type' => 'xsd:double'),
        'tipo' => array('name' => 'tipo', 'type' => 'xsd:int'),
        'idCuentaSecundaria' => array('name' => 'idCuentaSecundaria', 'type' => 'xsd:int'),
        'idBancoCuentaSecundaria' => array('name' => 'idBancoCuentaSecundaria', 'type' => 'xsd:int'),
	'idPrestamo' => array('name' => 'idPrestamo', 'type' => 'xsd:int'),
        'idSeguro' => array('name' => 'idSeguro', 'type' => 'xsd:int')
    )
);

$server->wsdl->addComplexType(
    'Prestamo',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'montoCuota' => array('name' => 'montoCuota', 'type' => 'xsd:double'),
        'totalPrestamo' => array('name' => 'totalPrestamo', 'type' => 'xsd:double'),
        'totalRecibir' => array('name' => 'totalRecibir', 'type' => 'xsd:double'),
        'fechaRegistro' => array('name' => 'fechaRegistro', 'type' => 'xsd:date'),
        'autorizado' => array('name' => 'autorizado', 'type' => 'xsd:int'),
	'fechaAutorizacion' => array('name' => 'fechaAutorizacion', 'type' => 'xsd:date'),
        'idTipoPrestamo' => array('name' => 'idTipoPrestamo', 'type' => 'xsd:int')
    )
);

$server->wsdl->addComplexType(
    'Seguro',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'automatico' => array('name' => 'automatico', 'type' => 'xsd:int'),
        'fechaRegistro' => array('name' => 'fechaRegistro', 'type' => 'xsd:date'),
        'monto' => array('name' => 'monto', 'type' => 'xsd:double'),
        'idTipoSeguro' => array('name' => 'idTipoSeguro', 'type' => 'xsd:int')
    )
);

$server->register('getIdsDocumentoIdentificacion',
			array(),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsDocumentoIdentificacion',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los tipos de documento de identificacion');  


$server->register('getDocumentoIdentificacion',
			array('id' => 'xsd:int'),  
			array('return' => 'tns:DocumentoIdentificacion'),  
			$namespace,   
			$namespace.'#getDocumentoIdentificacion',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del documento de identificacion');  

$server->register('getIdsTipoPrestamo',
			array(),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsTipoPrestamo',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los tipos de prestamo');  

$server->register('getTipoPrestamo',
			array('id' => 'xsd:int'),  
			array('return' => 'tns:TipoPrestamo'),  
			$namespace,   
			$namespace.'#getTipoPrestamo',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del tipo de prestamo');  

$server->register('getIdsTipoSeguro',
			array(),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsTipoSeguro',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los tipos de seguro');  

$server->register('getTipoSeguro',
			array('id' => 'xsd:int'),  
			array('return' => 'tns:TipoSeguro'),  
			$namespace,   
			$namespace.'#getTipoSeguro',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del tipo de seguro');  

$server->register('getIdsBanco',
			array(),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsBanco',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los bancos conocidos');  

$server->register('getBanco',
			array('id' => 'xsd:int'),  
			array('return' => 'tns:Banco'),  
			$namespace,   
			$namespace.'#getBanco',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del banco');

$server->register('addUser',
			array('nombre' => 'xsd:string', 'apellido' => 'xsd:string', 'telefono' => 'xsd:int', 'direccion' => 'xsd:string', 'idDocIdentificacion' => 'xsd:int', 'numDocIdentificacion' => 'xsd:string', 'email' => 'xsd:string'),  
			array('return' => 'tns:UsuarioRegistro'),  
			$namespace,   
			$namespace.'#addUser',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del registro de un usuario');

$server->register('login',
			array('usuario' => 'xsd:string', 'password' => 'xsd:string'),  
			array('return' => 'tns:Respuesta'),  
			$namespace,   
			$namespace.'#login',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del login de un usuario');

$server->register('logout',
			array('usuario' => 'xsd:string'),  
			array('return' => 'tns:Respuesta'),  
			$namespace,   
			$namespace.'#logout',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del logout de un usuario');

$server->register('getInfoUsuario',
			array('usuario' => 'xsd:string'),  
			array('return' => 'tns:Usuario'),  
			$namespace,   
			$namespace.'#getInfoUsuario',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del usuario');

$server->register('setPassword',
			array('usuario' => 'xsd:string', 'password' => 'xsd:string'),  
			array('return' => 'tns:Respuesta'),  
			$namespace,   
			$namespace.'#setPassword',  
			'rpc', 
			'encoded', 
			'Cambia el password del usuario');

$server->register('getIdsCuenta',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string'),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsCuenta',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de las cuentas de un usuario');  

$server->register('getCuenta',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string'),  
			array('return' => 'tns:Cuenta'),  
			$namespace,   
			$namespace.'#getCuenta',  
			'rpc', 
			'encoded', 
			'Devuelve informacion de una cuenta del usuario');

$server->register('addCuenta',
			array('usuario' => 'xsd:string'),  
			array('return' => 'tns:CuentaNueva'),  
			$namespace,   
			$namespace.'#addCuenta',  
			'rpc', 
			'encoded', 
			'Devuelve informacion de una cuenta nueva del usuario');

$server->register('addMovimientoLocal',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string', 'tipoOperacion' => 'xsd:int', 'monto' => 'xsd:double'),  
			array('return' => 'tns:MovimientoLocal'),  
			$namespace,   
			$namespace.'#addMovimientoLocal',  
			'rpc', 
			'encoded', 
			'Agrega un movimiento local a una cuenta');

$server->register('addTransferenciaLocal',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string', 'idCuentaSecundaria'=> 'xsd:int', 'tipoOperacion' => 'xsd:int', 'monto' => 'xsd:double'),  
			array('return' => 'tns:MovimientoLocal'),  
			$namespace,   
			$namespace.'#addTransferenciaLocal',  
			'rpc', 
			'encoded', 
			'Agrega una transferencia local entre cuentas');

$server->register('getIdsMovimiento',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string'),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsMovimiento',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los movimientos de una cuenta');  

$server->register('getMovimiento',
			array('idCuenta' => 'xsd:int', 'idMovimiento' => 'xsd:int'),  
			array('return' => 'tns:Movimiento'),  
			$namespace,   
			$namespace.'#getMovimiento',  
			'rpc', 
			'encoded', 
			'Devuelve información de un movimiento de la cuenta');  

$server->register('getIdsPrestamoCuenta',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string'),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsMovimiento',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los prestamos de una cuenta'); 

$server->register('getPrestamo',
			array('idPrestamo' => 'xsd:int'),  
			array('return' => 'tns:Prestamo'),  
			$namespace,   
			$namespace.'#getPrestamo',  
			'rpc', 
			'encoded', 
			'Devuelve información de un prestamo de la cuenta');  

$server->register('addPrestamo',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string', 'montoCuota' => 'xsd:double', 'totalPrestamo' => 'xsd:double', 'totalRecibir' => 'xsd:double', 'idTipoPrestamo' => 'xsd:int'),  
			array('return' => 'tns:Respuesta'),  
			$namespace,   
			$namespace.'#addPrestamo',  
			'rpc', 
			'encoded', 
			'Devuelve informacion del registro de un prestamo');

$server->register('getIdsPrestamoSinAutorizar',
			array(),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsPrestamoSinAutorizar',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los prestamos sin autorizar'); 

$server->register('setAutorizarPrestamo',
			array('id' => 'xsd:int'),  
			array('return' => 'tns:Respuesta'),  
			$namespace,   
			$namespace.'#setAutorizarPrestamo',  
			'rpc', 
			'encoded', 
			'Autorizar prestamo');

$server->register('addPagoPrestamo',
			array('idPrestamo'=> 'xsd:int','idCuenta' => 'xsd:int'),  
			array('return' => 'tns:MovimientoLocal'),  
			$namespace,   
			$namespace.'#addPagoPrestamo',  
			'rpc', 
			'encoded', 
			'Devuelve información del pago de una cuota del prestamo de la cuenta');

$server->register('getIdsSeguroCuenta',
			array('id' => 'xsd:int', 'usuario' => 'xsd:string'),  
			array('return' => 'tns:ListaIds'),  
			$namespace,   
			$namespace.'#getIdsSeguroCuenta',  
			'rpc', 
			'encoded', 
			'Devuelve IDS de los seguros de una cuenta'); 

$server->register('getSeguro',
			array('idCuenta' => 'xsd:int', 'idSeguro' => 'xsd:int'),  
			array('return' => 'tns:Seguro'),  
			$namespace,   
			$namespace.'#getSeguro',  
			'rpc', 
			'encoded', 
			'Devuelve información de un seguro de la cuenta');

  
$server->register('addSeguro',
			array('idCuenta' => 'xsd:int','automatico' => 'xsd:int', 'monto' => 'xsd:double', 'idTipoSeguro'=> 'xsd:int'),  
			array('return' => 'tns:Respuesta'),  
			$namespace,   
			$namespace.'#addSeguro',  
			'rpc', 
			'encoded', 
			'Devuelve información del registro de un seguro de la cuenta');


$server->register('addPagoSeguro',
			array('idCuenta' => 'xsd:int','idSeguro' => 'xsd:int'),  
			array('return' => 'tns:MovimientoLocal'),  
			$namespace,   
			$namespace.'#addPagoSeguro',  
			'rpc', 
			'encoded', 
			'Devuelve información del pago de un seguro de la cuenta');

function getIdsDocumentoIdentificacion() {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT iddocumentoidentificacion FROM documentoidentificacion');
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDDOCUMENTOIDENTIFICACION'] !== null){
			$cantidad++;
			$ids[] = $row['IDDOCUMENTOIDENTIFICACION'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

 
function getDocumentoIdentificacion($id) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT nombre FROM documentoidentificacion WHERE iddocumentoidentificacion = '.$id);
	oci_execute($stid);
	$resultado = 2;
	$nombre = '';
	if (($row = oci_fetch_array($stid)) != false) {		
		if ($row['NOMBRE'] !== null){
			$resultado = 1;
			$nombre = $row['NOMBRE'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('resultado'=>$resultado, 'nombre'=>$nombre);

}

function getIdsTipoPrestamo() {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idtipoprestamo FROM tipoprestamo');
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDTIPOPRESTAMO'] !== null){
			$cantidad++;
			$ids[] = $row['IDTIPOPRESTAMO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getTipoPrestamo($id) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT min,max,tasainteres,cantidadcuotas FROM tipoprestamo WHERE idtipoprestamo = '.$id);
	oci_execute($stid);
	$resultado = 2;
	$min = -1.0;
	$max = -1.0;
	$tasaInteres = -1.0;
	$cantidadCuotas = -1;

	if (($row = oci_fetch_array($stid)) != false) {		
		$resultado = 1;
		$min = $row['MIN'];
		$max = $row['MAX'];
		$tasaInteres = $row['TASAINTERES'];
		$cantidadCuotas = $row['CANTIDADCUOTAS'];
		
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('resultado'=>$resultado, 'min'=>$min, 'max'=>$max, 'tasaInteres'=>$tasaInteres, 'cantidadCuotas'=>$cantidadCuotas);

}

function getIdsTipoSeguro() {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idtiposeguro FROM tiposeguro WHERE idestado = 1');
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDTIPOSEGURO'] !== null){
			$cantidad++;
			$ids[] = $row['IDTIPOSEGURO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getTipoSeguro($id) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT nombre,descripcion FROM tiposeguro WHERE idestado = 1 AND idtiposeguro = '.$id);
	oci_execute($stid);
	$resultado = 2;
	$nombre = '';
	$descripcion = '';

	if (($row = oci_fetch_array($stid)) != false) {		
		$resultado = 1;
		$nombre = $row['NOMBRE'];
		$descripcion = $row['DESCRIPCION'];
		
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('resultado'=>$resultado, 'nombre'=>$nombre, 'descripcion'=>$descripcion);

}

function getIdsBanco() {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idbanco FROM banco');
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDBANCO'] !== null){
			$cantidad++;
			$ids[] = $row['IDBANCO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getBanco($id) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT nombre,direccionIP,puerto FROM banco WHERE idbanco = '.$id);
	oci_execute($stid);
	$resultado = 2;
	$nombre = '';
	$direccionIP = '';
	$puerto = -1;
	if (($row = oci_fetch_array($stid)) != false) {		
		$resultado = 1;
		$nombre = $row['NOMBRE'];
		$direccionIP = $row['DIRECCIONIP'];
		$puerto = $row['PUERTO'];
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('resultado'=>$resultado, 'nombre'=>$nombre, 'direccionIP'=>$direccionIP, 'puerto'=>$puerto);

}

function addUser($nombre, $apellido, $telefono, $direccion, $idDocIdentificacion, $numDocIdentificacion, $email) {
	include 'confBD.php';

	$conn = oci_connect($userBD, $passBD, $ipBD);

	$stid = oci_parse($conn, 'SELECT id_usuario.nextval FROM dual');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$idUsuario = $row['NEXTVAL'];
	}
	
	oci_free_statement($stid);
	
	$stid = oci_parse($conn, 'INSERT INTO usuario VALUES ('.$idUsuario.', \'usuario'.$idUsuario.'\', \''.$nombre.'\', \''.$apellido.'\', '.$telefono.', \''.$direccion.'\', \'pass'.$idUsuario.'\', 1, (SELECT sysdate FROM dual), \''.$numDocIdentificacion.'\', '.$idDocIdentificacion.', \''.$email.'\', 0)');

	if(oci_execute($stid)){
		$resultado = 1;
		$mensaje = "Exito usuario".$idUsuario;
	}else{
		$resultado = 2;
		$error = oci_error($stid);
		$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje, 'usuario'=>'usuario'.$idUsuario, 'password'=>'pass'.$idUsuario);
}

function login($usuario, $password) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT usuario FROM usuario WHERE usuario = \''.$usuario.'\'');
	oci_execute($stid);

	if (($row = oci_fetch_array($stid)) != false) {	
		oci_free_statement($stid);
		$stid = oci_parse($conn, 'SELECT usuario FROM usuario WHERE usuario = \''.$usuario.'\' AND password = \''.$password.'\'');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			oci_free_statement($stid);
			$stid = oci_parse($conn, 'SELECT usuario FROM usuario WHERE usuario = \''.$usuario.'\' AND password = \''.$password.'\' AND sesion = 0');
			oci_execute($stid);
			if (($row = oci_fetch_array($stid)) != false) {
				oci_free_statement($stid);
				$resultado = 1;		
				$mensaje = 'Bienvenido '.$row['USUARIO'];
				oci_free_statement($stid);
				$stid = oci_parse($conn, 'UPDATE usuario SET sesion = 1 WHERE usuario = \''.$usuario.'\'');
				oci_execute($stid);
				oci_free_statement($stid);
			}else{
				oci_free_statement($stid);
				$resultado = 4;		
				$mensaje = 'Error: El cliente '.$usuario.' ya tiene una sesion activa';
			}
		}else{
			oci_free_statement($stid);
			$resultado = 3;		
			$mensaje = 'Error: password incorrecto.';
		}		
	}else{
		oci_free_statement($stid);
		$resultado = 2;		
		$mensaje = 'Error: El cliente '.$usuario.' no existe.';
	}
	
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje);
}

function logout($usuario) {
	include 'confBD.php';
	
	$conn = oci_connect($userBD, $passBD, $ipBD);	
	$stid = oci_parse($conn, 'SELECT usuario FROM usuario WHERE usuario = \''.$usuario.'\'');	
	oci_execute($stid);
	
	if (($row = oci_fetch_array($stid)) != false) {			
		oci_free_statement($stid);
		$stid = oci_parse($conn, 'SELECT usuario FROM usuario WHERE usuario = \''.$usuario.'\' AND sesion = 1');
		oci_execute($stid);

		if (($row = oci_fetch_array($stid)) != false) {	
			oci_free_statement($stid);
			$stid = oci_parse($conn, 'UPDATE usuario SET sesion = 0 WHERE usuario = \''.$usuario.'\'');
			oci_execute($stid);
			$resultado = 1;		
			$mensaje = 'Sesion cerrada '.$row['USUARIO'];
			oci_free_statement($stid);
		}else{
			oci_free_statement($stid);
			$resultado = 2;		
			$mensaje = 'Error: El cliente '.$usuario.' no tiene sesion activa.';
		}
		
	}else{
		oci_free_statement($stid);
		$resultado = 2;		
		$mensaje = 'Error: El cliente '.$usuario.' no existe.';
	}

	oci_close($conn);

	return array('resultado'=>$resultado, 'mensaje'=>$mensaje);
}

function getInfoUsuario($id) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT * FROM usuario WHERE usuario = \''.$id.'\'');
	oci_execute($stid);
	$resultado = 2;
	$idUsuario = -1;
	$nombre = '';
	$apellido = '';
	$telefono = -1;
	$direccion = '';
	$cambiarPass = -1;
	$fechaRegistro = '';
	$idDocIdentificacion = -1;
	$numDocIdentificacion = '';
	$email = '';
	if (($row = oci_fetch_array($stid)) != false) {		
		$resultado = 1;
		$idUsuario = $row['IDUSUARIO'];
		$nombre = $row['NOMBRE'];
		$apellido = $row['APELLIDO'];
		$telefono = $row['TELEFONO'];
		$direccion = $row['DIRECCION'];
		$cambiarPass = $row['CAMBIARPASS'];
		$fechaRegistro = $row['FECHAREGISTRO'];
		$idDocIdentificacion = $row['IDDOCUMENTOIDENTIFICACION'];
		$numDocIdentificacion = $row['NUMDOCUMENTOIDENTIFICACION'];
		$email = $row['EMAIL'];
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('resultado'=>$resultado, 'id'=>$idUsuario, 'nombre'=>$nombre, 'apellido'=>$apellido, 'telefono'=>$telefono, 'direccion'=>$direccion, 'cambiarPass'=>$cambiarPass, 'fechaRegistro'=>$fechaRegistro, 'idDocIdentificacion'=>$idDocIdentificacion, 'numDocIdentificacion'=>$numDocIdentificacion, 'email'=>$email);

}

function setPassword($usuario, $password) {
	include 'confBD.php';
	
	$conn = oci_connect($userBD, $passBD, $ipBD);	
	$stid = oci_parse($conn, 'UPDATE usuario set password = \''.$password.'\', cambiarPass = 0 WHERE usuario = \''.$usuario.'\'');	
	if(oci_execute($stid)){
		$resultado = 1;
		$mensaje = 'Password modificado exitosamente';
	}else{
		$resultado = 2;
		$error = oci_error($stid);
		$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
	}
	
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje);

}

function getIdsCuenta($id, $usuario) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT usuario FROM usuario WHERE idusuario = '.$id.' AND usuario =\''.$usuario.'\'');
	oci_execute($stid);

	$ids = array();
	if (($row = oci_fetch_array($stid)) != false) {	
		oci_free_statement($stid);
		$stid = oci_parse($conn, 'SELECT idCuenta FROM cuenta WHERE idusuario = '.$id.' AND idestado = 1 order by fechaCreacion, idCuenta');
		oci_execute($stid);
		while (($row = oci_fetch_array($stid)) != false) {		
			if ($row['IDCUENTA'] !== null){
				$cantidad++;
				$ids[] = $row['IDCUENTA'];
			}
		}
		oci_free_statement($stid);
	}
	
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getCuenta($id, $usuario) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT to_char(fechaCreacion, \'DD/MM/YYYY HH24:MI:SS\') fechacreacion_ , getSaldo('.$id.') saldo FROM cuenta WHERE idCuenta = '.$id.' AND idestado = 1');
	oci_execute($stid);

	if (($row = oci_fetch_array($stid)) != false) {	
		$saldo = $row['SALDO'];
		$fechaCreacion = $row['FECHACREACION_'];		
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('fechaCreacion'=>$fechaCreacion, 'saldo'=>$saldo);
}


function addCuenta($usuario) {
	include 'confBD.php';
	
	$conn = oci_connect($userBD, $passBD, $ipBD);

	$stid = oci_parse($conn, 'SELECT idusuario from usuario where usuario = \''.$usuario.'\'');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {
		oci_free_statement($stid);	
		$idUsuario = $row['IDUSUARIO'];
		
	
		$stid = oci_parse($conn, 'SELECT id_cuenta.nextval FROM dual');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$idCuenta = $row['NEXTVAL'];
		}	
		oci_free_statement($stid);

		$stid = oci_parse($conn, 'SELECT to_char(sysdate, \'DD/MM/YYYY HH24:MI:SS\') as time FROM dual');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$fechaCreacion = $row['TIME'];
		}	
		oci_free_statement($stid);

		$stid = oci_parse($conn, 'INSERT INTO cuenta VALUES('.$idCuenta.',  (SELECT sysdate FROM dual), \''.$idUsuario.'\', 1)');	
		
		if(oci_execute($stid)){
			$resultado = 1;
		}else{
			$resultado = 2;
			$idCuenta = -1;
			$fechaCreacion = '';
		}
	}	

	return array('resultado'=>$resultado, 'id'=>$idCuenta, 'fechaCreacion'=>$fechaCreacion);
}

function addMovimientoLocal($id, $usuario, $tipoOperacion, $monto) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$idMovimiento = $row['NEXTVAL'];
	}	
	oci_free_statement($stid);
	if($tipoOperacion == 2){
		$stid = oci_parse($conn, 'SELECT 1 FROM (SELECT getSaldo('.$id.')-'.$monto.' s FROM dual) WHERE s>0');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$saldoSuficiente = $row['1'];
		}	
		oci_free_statement($stid);
	}else{
		$saldoSuficiente = 1;
	}	

	if($saldoSuficiente == 1){
		$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento.',  (SELECT sysdate FROM dual), '.$monto.', '.$id.', null, null, null, '.$tipoOperacion.', null, null)');	
		
		if(oci_execute($stid)){
			oci_free_statement($stid);
			$stid = oci_parse($conn, 'SELECT getSaldo('.$id.') s FROM dual');
			oci_execute($stid);
			if (($row = oci_fetch_array($stid)) != false) {	
				$saldo = $row['S'];
			}	
			oci_free_statement($stid);

			$resultado = 1;
			$mensaje = "Movimiento realizado. Correlativo: ".$idMovimiento;
		}else{
			$resultado = 2;
			$error = oci_error($stid);
			$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
			oci_free_statement($stid);
		}
				
	}else{
		$resultado = 2;
		$mensaje = "Error: Saldo insuficiente";
		$saldo = -1;
	}
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje, 'saldo'=>$saldo);
}


function addTransferenciaLocal($id, $usuario, $idCuentaSecundaria, $tipoOperacion, $monto) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);

	$stid = oci_parse($conn, 'SELECT 1 FROM cuenta where idcuenta = '.$idCuentaSecundaria);
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$existeOtraCuenta = $row['1'];
	}	
	oci_free_statement($stid);

	if($existeOtraCuenta == 1){
		$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$idMovimiento = $row['NEXTVAL'];
		}	
		oci_free_statement($stid);
		$saldoSuficiente = 0;
		if($tipoOperacion == 1){
			$stid = oci_parse($conn, 'SELECT 1 FROM (SELECT getSaldo('.$idCuentaSecundaria.')-'.$monto.' s FROM dual) WHERE s>0');
			oci_execute($stid);
			if (($row = oci_fetch_array($stid)) != false) {	
				$saldoSuficiente = $row['1'];
			}	
			oci_free_statement($stid);
		}else{
			$stid = oci_parse($conn, 'SELECT 1 FROM (SELECT getSaldo('.$id.')-'.$monto.' s FROM dual) WHERE s>0');
			oci_execute($stid);
			if (($row = oci_fetch_array($stid)) != false) {	
				$saldoSuficiente = $row['1'];
			}	
			oci_free_statement($stid);
		}	

		if($saldoSuficiente == 1){
			$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento.',  (SELECT sysdate FROM dual), '.$monto.', '.$id.', '.$idCuentaSecundaria.', null, null, '.$tipoOperacion.', null, null)');	
			
			if(oci_execute($stid)){
				oci_free_statement($stid);
				
				$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$idMovimiento2 = $row['NEXTVAL'];
				}	
				oci_free_statement($stid);

				$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento2.',  (SELECT sysdate FROM dual), '.$monto.', '.$idCuentaSecundaria.', '.$id.', null, null, '.(3-$tipoOperacion).', null, null)');	
				oci_execute($stid);
				oci_free_statement($stid);

				$stid = oci_parse($conn, 'SELECT getSaldo('.$id.') s FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$saldo = $row['S'];
				}	
				oci_free_statement($stid);

				$resultado = 1;
				$mensaje = "Movimiento realizado. Correlativo: ".$idMovimiento;
			}else{
				$resultado = 2;
				$error = oci_error($stid);
				$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
				oci_free_statement($stid);
			}
				
		}else{
			if($tipoOperacion == 1){
				$resultado = 4;
				$mensaje = "Error: Saldo insuficiente de la otra cuenta";
				$saldo = -1;
			}else{
				$resultado = 3;
				$mensaje = "Error: Saldo insuficiente de la cuenta local";
				$saldo = -1;
			}
		
		}
	}else{
		$resultado = 2;
		$mensaje = "Error: la otra cuenta no existe";
		$saldo = -1;
	}
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje, 'saldo'=>$saldo);
}

function getIdsMovimiento($id, $usuario) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idMovimiento FROM movimiento where idCuenta = '.$id);
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDMOVIMIENTO'] !== null){
			$cantidad++;
			$ids[] = $row['IDMOVIMIENTO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getMovimiento($idCuenta, $idMovimiento) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT to_char(fecha, \'DD/MM/YYYY HH24:MI:SS\') FECHA_,monto,entrada,idCuentaSecundaria,idBanco,idPrestamo,idSeguro FROM movimiento WHERE idcuenta = '.$idCuenta.' AND idMovimiento='.$idMovimiento);
	
	$fecha = '';
	$monto = -1;
	$tipo = -1;
	$idCuentaSecundaria = -1;
	$idBancoCuentaSecundaria = -1;
	$idPrestamo = -1;
	$idSeguro = -1;
	oci_execute($stid);
	if (($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULL)) != false) {		
		
		$fecha = $row['FECHA_'];
		$monto = $row['MONTO'];
		$tipo = $row['ENTRADA'];
		$idCuentaSecundaria = $row['IDCUENTASECUNDARIA'];
		$idBancoCuentaSecundaria = $row['IDBANCO'];
		$idPrestamo = $row['IDPRESTAMO'];
		$idSeguro = $row['IDSEGURO'];
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('fecha'=>$fecha, 'monto'=>$monto, 'tipo'=>$tipo, 'idCuentaSecundaria'=>$idCuentaSecundaria, 'idBancoCuentaSecundaria'=>$idBancoCuentaSecundaria,'idPrestamo'=>$idPrestamo,'idSeguro'=>$idSeguro);

}

function getIdsPrestamoCuenta($id, $usuario) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idPrestamo FROM prestamo where idCuenta = '.$id);
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDPRESTAMO'] !== null){
			$cantidad++;
			$ids[] = $row['IDPRESTAMO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getPrestamo($idPrestamo) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT montoCuota,totalPrestamo,totalRecibir,to_char(fechaRegistro, \'DD/MM/YYYY HH24:MI:SS\') FECHA_,to_char(fechaAutorizacion, \'DD/MM/YYYY HH24:MI:SS\') FECHAAUTORIZACION_,autorizado,idTipoPrestamo FROM prestamo WHERE idprestamo = '.$idPrestamo);
	
	$montoCuota = -1;
	$totalPrestamo = -1;
	$totalRecibir = -1;
	$fechaRegistro = -1;
	$autorizado = '';
	$fechaAutorizacion = -1;
	$idTipoPrestamo = -1;

	oci_execute($stid);
	if (($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULL)) != false) {		
		
		$montoCuota = $row['MONTOCUOTA'];
		$totalPrestamo = $row['TOTALPRESTAMO'];
		$totalRecibir = $row['TOTALRECIBIR'];
		$fechaRegistro = $row['FECHA_'];
		$autorizado = $row['AUTORIZADO'];
		$idTipoPrestamo = $row['IDTIPOPRESTAMO'];
		$fechaAutorizacion = $row['FECHAAUTORIZACION_'];
	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('montoCuota'=>$montoCuota, 'totalPrestamo'=>$totalPrestamo, 'totalRecibir'=>$totalRecibir, 'fechaRegistro'=>$fechaRegistro,'autorizado'=>$autorizado,'fechaAutorizacion'=>$fechaAutorizacion,'idTipoPrestamo'=>$idTipoPrestamo);

}

function addPrestamo($id, $usuario, $montoCuota, $totalPrestamo, $totalRecibir, $idTipoPrestamo) {
	include 'confBD.php';

	$conn = oci_connect($userBD, $passBD, $ipBD);

	$stid = oci_parse($conn, 'SELECT id_prestamo.nextval FROM dual');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$idPrestamo = $row['NEXTVAL'];
	}
	
	oci_free_statement($stid);
	
	$stid = oci_parse($conn, 'INSERT INTO prestamo VALUES ('.$idPrestamo.', '.$montoCuota.', '.$totalPrestamo.', '.$totalRecibir.', (SELECT sysdate FROM dual), '.$id.', 1, '.$idTipoPrestamo.', 0, null)');

	if(oci_execute($stid)){
		$resultado = 1;
		$mensaje = "Exito: prestamo creado. Correlativo:".$idPrestamo;
	}else{
		$resultado = 2;
		$error = oci_error($stid);
		$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje);
}

function getIdsPrestamoSinAutorizar() {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idPrestamo FROM prestamo where autorizado = 0');
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDPRESTAMO'] !== null){
			$cantidad++;
			$ids[] = $row['IDPRESTAMO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function setAutorizarPrestamo($id) {
	include 'confBD.php';
	
	$conn = oci_connect($userBD, $passBD, $ipBD);	
	$idPrestamo = 0;
	$stid = oci_parse($conn, 'SELECT idPrestamo FROM prestamo where idPrestamo='.$id);
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$idPrestamo = 1;
	}
	
	oci_free_statement($stid);
	
	if($idPrestamo == 1){
		$idPrestamo = 0;
		$stid = oci_parse($conn, 'SELECT idPrestamo FROM prestamo where idPrestamo='.$id.' AND autorizado=0');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$idPrestamo = 1;
		}
		oci_free_statement($stid);
		if($idPrestamo == 1){
			$stid = oci_parse($conn, 'UPDATE prestamo set autorizado = 1, fechaAutorizacion = sysdate WHERE idPrestamo = '.$id);	
			if(oci_execute($stid)){
				oci_free_statement($stid);

				$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$idMovimiento = $row['NEXTVAL'];
				}
	
				oci_free_statement($stid);

				$stid = oci_parse($conn, 'SELECT totalPrestamo,idCuenta FROM prestamo where idprestamo = '.$id);
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$totalPrestamo = $row['TOTALPRESTAMO'];
					$idCuenta = $row['IDCUENTA'];
				}
	
				oci_free_statement($stid);
	
				$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento.',  (SELECT sysdate FROM dual), '.$totalPrestamo.', '.$idCuenta.', null, '.$id.', null, 1, null, null)');	
				oci_execute($stid);
				$resultado = 1;
				$mensaje = 'Prestamo autorizado';
			}else{
				$resultado = 2;
				$error = oci_error($stid);
				$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
			}
		}else{
			$resultado = 2;
			$mensaje = "Error: el prestamo ya fue autorizado";
		}
	}else{
		$resultado = 3;
		$mensaje = "Error: el prestamo no existe";
	}
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje);

}

function addPagoPrestamo($idPrestamo, $idCuenta) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT montoCuota FROM prestamo WHERE idprestamo ='.$idPrestamo.' AND idEstado = 1 AND autorizado = 1');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$monto = $row['MONTOCUOTA'];
	}	
	oci_free_statement($stid);
	if($monto > 0){

		$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$idMovimiento = $row['NEXTVAL'];
		}	
		oci_free_statement($stid);
		$saldoSuficiente = 0;
		$stid = oci_parse($conn, 'SELECT 1 FROM (SELECT getSaldo('.$idCuenta.')-'.$monto.' s FROM dual) WHERE s>0');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$saldoSuficiente = $row['1'];
		}	
		oci_free_statement($stid);

		if($saldoSuficiente == 1){
			$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento.',  (SELECT sysdate FROM dual), '.$monto.', '.$idCuenta.', null, '.$idPrestamo.', null, 2, null, null)');	
		
			if(oci_execute($stid)){
				oci_free_statement($stid);
				$stid = oci_parse($conn, 'SELECT getSaldo('.$idCuenta.') s FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$saldo = $row['S'];
				}	
				oci_free_statement($stid);

				$stid = oci_parse($conn, 'SELECT getSaldoRestantePrestamo('.$idPrestamo.') restante FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$saldoRestante = $row['RESTANTE'];
				}	
				oci_free_statement($stid);
				if(!($saldoRestante > 0)){
					$stid = oci_parse($conn, 'UPDATE prestamo set idEstado = 3 where idPrestamo ='.$idPrestamo);
					oci_execute($stid);
					oci_free_statement($stid);
				}
				$resultado = 1;
				$mensaje = "Movimiento realizado. Correlativo: ".$idMovimiento;
		
			}else{
				$resultado = 2;
				$error = oci_error($stid);
				$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
				oci_free_statement($stid);
			}
				
		}else{
			$resultado = 2;
			$mensaje = "Error: Saldo insuficiente";
			$saldo = -1;
		}
	}else{
		$resultado = 3;
		$mensaje = "Error: el prestamo ya se encuentra pagado totalmente";
	}
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje, 'saldo'=>$saldo);
}



function getIdsSeguroCuenta($id, $usuario) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'SELECT idSeguro FROM seguro where idCuenta = '.$id);
	oci_execute($stid);

	$ids = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDSEGURO'] !== null){
			$cantidad++;
			$ids[] = $row['IDSEGURO'];
		}
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('cantidad'=>$cantidad, 'array'=>$ids);
}

function getSeguro($idCuenta, $idSeguro) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT automatico,to_char(fechaRegistro, \'DD/MM/YYYY HH24:MI:SS\') FECHA_,monto,idTipoSeguro FROM seguro WHERE idseguro = '.$idSeguro .' AND idcuenta = '.$idCuenta);
	
	$automatico = -1;
	$fechaRegistro = -1;
	$monto = '';
	$idTipoSeguro = -1;

	oci_execute($stid);
	if (($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULL)) != false) {		
		
		$automatico = $row['AUTOMATICO'];
		$fechaRegistro = $row['FECHA_'];
		$monto = $row['MONTO'];
		$idTipoSeguro = $row['IDTIPOSEGURO'];

	}
	oci_free_statement($stid);
	oci_close($conn);

	return array('automatico'=>$automatico, 'fechaRegistro'=>$fechaRegistro,'monto'=>$monto,'idTipoSeguro'=>$idTipoSeguro);

}

function addSeguro($idCuenta, $automatico, $monto, $idTipoSeguro) {
	include 'confBD.php';

	$conn = oci_connect($userBD, $passBD, $ipBD);

	$stid = oci_parse($conn, 'SELECT id_seguro.nextval FROM dual');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$idSeguro = $row['NEXTVAL'];
	}
	
	oci_free_statement($stid);
	
	$stid = oci_parse($conn, 'INSERT INTO seguro VALUES ('.$idSeguro.', '.$automatico.', '.$idCuenta.', 1, '.$idTipoSeguro.', (SELECT sysdate FROM dual), '.$monto.')');

	if(oci_execute($stid)){
		$resultado = 1;
		$mensaje = "Exito: seguro creado. Correlativo:".$idSeguro;
	}else{
		$resultado = 2;
		$error = oci_error($stid);
		$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
	}
	oci_free_statement($stid);
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje);
}

function addPagoSeguro($idCuenta, $idSeguro) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT monto, idTipoSeguro FROM seguro WHERE idseguro ='.$idSeguro.' AND idEstado = 1');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$monto = $row['MONTO'];
		$idTipoSeguro = $row['IDTIPOSEGURO'];
	}	
	oci_free_statement($stid);
	if($monto > 0){

		$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$idMovimiento = $row['NEXTVAL'];
		}	
		oci_free_statement($stid);
		$saldoSuficiente = 0;
		$stid = oci_parse($conn, 'SELECT 1 FROM (SELECT getSaldo('.$idCuenta.')-'.$monto.' s FROM dual) WHERE s>0');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$saldoSuficiente = $row['1'];
		}	
		oci_free_statement($stid);

		if($saldoSuficiente == 1){
			$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento.',  (SELECT sysdate FROM dual), '.$monto.', '.$idCuenta.', null, null, '.$idSeguro.', 2, '.$idTipoSeguro.', null)');	
		
			if(oci_execute($stid)){
				oci_free_statement($stid);
				$stid = oci_parse($conn, 'SELECT getSaldo('.$idCuenta.') s FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$saldo = $row['S'];
				}	
				oci_free_statement($stid);
				$resultado = 1;
				$mensaje = "Movimiento realizado. Correlativo: ".$idMovimiento;
			}else{
				$resultado = 2;
				$error = oci_error($stid);
				$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
				oci_free_statement($stid);
			}
				
		}else{
			$resultado = 2;
			$mensaje = "Error: Saldo insuficiente";
			$saldo = -1;
		}
	}else{
		$resultado = 3;
		$mensaje = "Error: el seguro no existe o no se encuentra activo.";
	}
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje, 'saldo'=>$saldo);
}



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);
exit();
?>
