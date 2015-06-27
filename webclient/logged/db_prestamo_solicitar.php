<?php
require_once('../classes/Admon.php');

$numCuenta = $_POST['numCuenta'];
$montoCuota = $_POST['montoCuota'];
$totalPrestamo = $_POST['totalPrestamo'];
$totalRecibir = $_POST['totalRecibir'];
$idTipoPrestamo = $_POST['idTipoPrestamo'];

if( $totalPrestamo < 5000 ){
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "No ofrecemos préstamos menores a Q5,000.00" );';
	echo 'window.location = "prestamo_solicitar_monto.php"';
	echo '</script>';
}else{
	//crear prestamo
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	$admon->usuarioActual->actualizarCuentas();
	//$cuenta = $admon->usuarioActual->getCuenta( $numCuenta );
	//$resultado = $cuenta->depositar( $admon->usuarioActual->usuario, $monto );
	$prestamo = new Prestamo( $montoCuota, $totalPrestamo, $totalRecibir, $idTipoPrestamo );
	$resultado = $prestamo->crear( $numCuenta, $admon->usuarioActual->usuario );
	if( $resultado[0] == 1 ){
		//$admon->usuarioActual->actualizarCuentas();
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'.$resultado[1].'" );';
		echo 'window.location = "prestamos_visualizar.php"';
		echo '</script>';
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'.$resultado[1].'" );';
		echo 'window.location = "prestamo_solicitar_monto.php"';
		echo '</script>';
	}
}
?>