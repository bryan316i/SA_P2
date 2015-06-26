<?php
	require_once('classes/Admon.php');
	
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$mensaje = $_POST['mensaje'];
	
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "Nos pondremos en contacto" );';
	echo 'window.location = "index.html"';
	echo '</script>';
?>