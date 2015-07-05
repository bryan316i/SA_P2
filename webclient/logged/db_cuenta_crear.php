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
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	$resultado = $admon->usuarioActual->crearCuenta( $monto );
	echo "Cuentas: ".count( $admon->usuarioActual->strListaCuenta );
	if( $resultado[0] == 1 ){
		//$admon->usuarioActual->actualizarCuentas();
		//realizar deposito
		/*$admon->usuarioActual->actualizarCuentas();
		$prueba = $admon->usuarioActual->getCuenta( 29 );
		echo '<tr>';
		echo '<td>';
		echo '6666';
		echo 'dddd'.$prueba->id;
		echo '</td>';
		echo '</tr>';*/
		$admon->usuarioActual->actualizarCuentas();
		$cuenta = $admon->usuarioActual->getCuenta( $resultado[1] );
		//echo 'dddd'.$resultado[1];
		if( strcmp( $_SESSION['banco'], "PHP" ) == 0 ){
			$resultado = $cuenta->depositar( $admon->usuarioActual->usuario, $monto );
		}elseif( strcmp( $_SESSION['banco'], "ASP" ) == 0 ){
			$resultado = array( 1, $resultado[1] );
		}else{
			//PENDIENTE
		}
		$_SESSION['admon'] = serialize( $admon );
		if( $resultado[0] == 1 ){
			//$admon->usuarioActual->actualizarCuentas();
			//mensaje y redirigir
			echo '<script language="javascript">';
			echo 'alert( "Cuenta creada con éxito, '.$resultado[1].'" );';
			echo 'window.location = "cuentas_visualizar.php"';
			echo '</script>';
		}else{
			//mensaje y redirigir
			echo '<script language="javascript">';
			echo 'alert( "Cuenta creada con éxito. Depósito pendiente. '.$resultado[1].'" );';
			echo 'window.location = "cuenta_deposito.php"';
			echo '</script>';
		}
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "Error al crear la cuenta" );';
		echo 'window.location = "cuenta_crear.php"';
		echo '</script>';
	}
}
?>