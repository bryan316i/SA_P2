<?php
require_once('../classes/Admon.php');

$numCuenta = $_POST['numCuenta'];
$monto = $_POST['monto'];

if( $monto < 50 ){
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "Debe retirar una cantidad mayor o igual a Q50.00" );';
	echo 'window.location = "cuenta_deposito.php"';
	echo '</script>';
}else{
	//crear deposito
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	$admon->usuarioActual->actualizarCuentas();
	$cuenta = $admon->usuarioActual->getCuenta( $numCuenta );
	$resultado = $cuenta->retiro( $admon->usuarioActual->usuario, $monto );
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
		echo 'window.location = "cuenta_deposito.php"';
		echo '</script>';
	}
}
?>