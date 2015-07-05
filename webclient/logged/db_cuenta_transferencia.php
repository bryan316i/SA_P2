<?php
require_once('../classes/Admon.php');

$numCuenta = $_POST['numCuenta'];
$monto = $_POST['monto'];
$numCuentaSec = $_POST['numCuentaSec'];
$banco = $_POST['banco'];

if( $monto < 50 ){
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "Debe transferir una cantidad mayor o igual a Q50.00" );';
	echo 'window.location = "cuenta_transferencia.php"';
	echo '</script>';
}else{
	//crear transferencia
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	
	if( strcmp( $_SESSION['banco'], "PHP" ) == 0 ){
		$admon->usuarioActual->actualizarCuentas();
		$cuenta = $admon->usuarioActual->getCuenta( $numCuenta );
		$resultado = $cuenta->transferencia( $admon->usuarioActual->usuario, $numCuentaSec, $monto, 2, $banco );
	}elseif( strcmp( $_SESSION['banco'], "ASP" ) == 0 ){
		$resultado = $admon->usuarioActual->transferencia_ASP( $numCuenta, $numCuentaSec, $monto, $banco );
	}else{
	}
	
	if( $resultado[0] == 1 ){
		//$admon->usuarioActual->actualizarCuentas();
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'.$resultado[1].'" );';
		echo 'window.location = "cuentas_visualizar.php"';
		echo '</script>';
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'.$resultado[1].'" );';
		echo 'window.location = "cuenta_transferencia.php"';
		echo '</script>';
	}
}
?>