<?php
require_once('../classes/Admon.php');

$numCuenta = $_POST['numCuenta'];
$idPrestamo = $_POST['idPrestamo'];

//crear deposito
session_start();
$admon = unserialize( $_SESSION['admon'] );
$admon->usuarioActual->actualizarCuentas();
$cuenta = $admon->usuarioActual->getCuenta( $numCuenta );
//$resultado = $cuenta->depositar( $admon->usuarioActual->usuario, $monto );*/
$cuenta->actualizarPrestamos( $admon->usuarioActual->id );
$prestamo = $cuenta->getPrestamo( $idPrestamo );
$resultado = $prestamo->pagar( $numCuenta );
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
	echo 'window.location = "prestamo_pagar.php"';
	echo '</script>';
}
?>