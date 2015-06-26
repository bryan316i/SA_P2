<?php
	require_once('../classes/Admon.php');
	
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	
	$pass = $_SESSION['pass'];
	$passSecure = $_SESSION['passSecure'];
	if( strcmp( $pass, $passSecure ) == 0 ){
		//cambiar contraseña
		$admon->usuarioActual->password = $pass;
		$resultado = $admon->usuarioActual->cambiarPassword();
		if( $resultado == 1 ){
			//actualiza sesion
			$_SESSION['admon'] = serialize( $admon );
			//mensaje y redirigir
			echo '<script language="javascript">';
			echo 'alert( "Contraseña cambiada exitosamente" );';
			echo 'window.location = "index.php"';
			echo '</script>';
		}else{
			//mensaje y redirigir
			echo '<script language="javascript">';
			echo 'alert( "Contraseña cambiada exitosamente" );';
			echo 'window.location = "index_cambiar_password.php"';
			echo '</script>';
		}
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "La contraseña no coincide" );';
		echo 'window.location = "index_cambiar_password.php"';
		echo '</script>';
	}
?>