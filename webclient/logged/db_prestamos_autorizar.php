<?php
require_once('../classes/Admon.php');

$idPrestamo = $_POST['idPrestamo'];

//autorizar prestamo
$admon = new Admon();
$resultado = $admon->autorizarPrestamo( $idPrestamo );
if( $resultado[0] == 1 ){
	//$admon->usuarioActual->actualizarCuentas();
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "'.$resultado[1].'" );';
	echo 'window.location = "../"';
	echo '</script>';
}else{
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "'.$resultado[1].'" );';
	echo 'window.location = "prestamos_solicitar.php"';
	echo '</script>';
}
?>