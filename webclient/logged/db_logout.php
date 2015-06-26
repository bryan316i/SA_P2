<?php
	require_once('../classes/Admon.php');
	
	$admon = unserialize( $_SESSION['admon'] );
	$resultado = $admon->usuarioActual->logout();
	if( $resultado[0] == 1 ){
		//cierra sesion
		unset( $_SESSION['admon'] );
		header( 'Location: ../' );
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'. $resultado[1] .'" );';
		echo 'window.location = "../"';
		echo '</script>';
	}

?>