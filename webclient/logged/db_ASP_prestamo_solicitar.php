<?php
require_once('../classes/Admon.php');

$totalPrestamo = $_POST['monto'];
$tasa = $_POST['tasa'];
$cantidadCuotas = $_POST['cantidadCuotas'];
/*$numCuenta = $_POST['numCuenta'];
$montoCuota = $_POST['montoCuota'];
$totalPrestamo = $_POST['totalPrestamo'];
$totalRecibir = $_POST['totalRecibir'];
$idTipoPrestamo = $_POST['idTipoPrestamo'];*/

if( $totalPrestamo < 1000 ){
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "No ofrecemos préstamos menores a Q1,000.00" );';
	echo 'window.location = "ASP_prestamo_solicitar.php"';
	echo '</script>';
}else{
	//crear prestamo
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	
	//$cuenta = $admon->usuarioActual->getCuenta( $numCuenta );
	//$resultado = $cuenta->depositar( $admon->usuarioActual->usuario, $monto );
	//$prestamo = new Prestamo( $montoCuota, $totalPrestamo, $totalRecibir, $idTipoPrestamo );
	//$resultado = $prestamo->crear( $numCuenta, $admon->usuarioActual->usuario );
	$resultado = $admon->usuarioActual->solicitarPrestamo_ASP( $totalPrestamo, $tasa, $cantidadCuotas );
	echo "Cantidad: ".count( $admon->usuarioActual->strListaPrestamo );
	$_SESSION['admon'] = serialize( $admon );
	if( $resultado[0] == 1 ){
		//$admon->usuarioActual->actualizarCuentas();
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'.$resultado[1].'" );';
		echo 'window.location = "ASP_prestamos_visualizar.php"';
		echo '</script>';
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'.$resultado[1].'" );';
		echo 'window.location = "ASP_prestamo_solicitar.php"';
		echo '</script>';
	}
}
?>