<?php
	require_once('classes/Admon.php');
	
	$admon = new Admon();
	$admon->actualizarDocsIdentif();
	
	$usuario = new Usuario( "" );
	$usuario->nombre = $_POST['nombre'];
	$usuario->apellido = $_POST['apellido'];
	$usuario->telefono = $_POST['telefono'];
	$usuario->direccion = $_POST['direccion'];
	$usuario->email = $_POST['email'];
	$usuario->numDocIdentificacion = $_POST['numDocIdentif'];
	$doc = $admon->getDocIdentif( $_POST['docIdentif'] );
	$usuario->idDocIdentificacion = $doc->id;
	
	$resultado = $usuario->crear();
	if( $resultado[0] == 1 ){
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'. $resultado[1] .'" );';
		echo 'window.location = "index.html"';
		echo '</script>';
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'. $resultado[1] .'" );';
		echo 'window.location = "registro.php"';
		echo '</script>';
	}
	
?>