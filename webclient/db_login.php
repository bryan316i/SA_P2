<?php
	require_once('classes/Admon.php');
	
	$usuario = $_POST['usuario'];
	$pass = $_POST['password'];
	
	$admon = new Admon();
	$resultado = $admon->login( $usuario, $pass );
	if( $resultado[0] == 1 ){
		$cambiarPass = $admon->usuarioActual->cambiarPass;
		//iniciar sesion
		session_start();
		$_SESSION['admon'] = serialize( $admon );
		if( $cambiarPass == 1 ){
			header('Location: logged/index_cambiar_password.php');
		}else{
			header('Location: logged/index.php');
		}
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'. $resultado[1] .'" );';
		echo 'window.location = "index.html"';
		echo '</script>';
	}
?>