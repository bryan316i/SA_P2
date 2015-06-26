<?php
require_once('../classes/Admon.php');

$monto = $_POST['monto'];
if( $monto < 100 ){
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "La cuenta debe tener un monto inicial mayor o igual a Q100.00" );';
	echo 'window.location = "cuenta_crear.php"';
	echo '</script>';
}else{
	//crear cuenta
	$admon = unserialize( $_SESSION['admon'] );
	$cuenta = new Cuenta();
	if( $cuenta->crear( $monto ) == true ){
		$admon->usuarioActual->listaCuenta[] = $cuenta;
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "Cuenta creada con éxito" );';
		echo 'window.location = "cuentas_visualizar.php"';
		echo '</script>';
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "Error al crear la cuenta" );';
		echo 'window.location = "cuenta_crear.php"';
		echo '</script>';
	}
}
?>