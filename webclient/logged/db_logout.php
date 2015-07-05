<?php
	require_once('../classes/Admon.php');
	
	session_start();
	$admon = unserialize( $_SESSION['admon'] );
	
	if( strcmp( $_SESSION['banco'], "PHP" ) == 0 ){
		$resultado = $admon->usuarioActual->logout();
	}else{
		$resultado[0] = 1;
	}
	
	if( $resultado[0] == 1 ){
		//cierra sesion
		unset( $_SESSION['admon'] );
		unset( $_SESSION['banco'] );
		header( 'Location: ../' );
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'. $resultado[1] .'" );';
		echo 'window.location = "../"';
		echo '</script>';
	}

?>