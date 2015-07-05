<?php
	require_once('classes/Admon.php');
	
	//$admon = new Admon();
	session_start();
	$_SESSION['banco'] =  $_POST['banco'];
	
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
	/*$resultado[0] = 1;
	$resultado[1] = "Exito";*/
	if( $resultado[0] == 1 ){
		//enviar correo
		$to      = $_POST['email'];
		$subject = 'BitBat Usuario';
		$message = "<html><body>";
		$message .= "Bienvenido, nos da gusto tenerte como cliente.";
		$message .= "<br><br>";
		$message .= "Tu usuario es: \"".$resultado[2]."\" y tu password: \"".$resultado[3]."\".";
		$message .= "<br><br>";
		$message .= "Saludos.";
		$message .= "<br><br>";
		$message .= "<img src=\"http://orig07.deviantart.net/e08d/f/2011/290/9/b/batman_logo_by_machsabre-d4d6sc7.png\" height=30 width=60>";
		$message .= "<br>";
		$message .= "Banco BitBat";
		$message .= "</body></html>";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$res = mail( $to, $subject, $message, $headers );
		//mensaje y redirigir
		if( $res ){
			echo '<script language="javascript">';
			echo 'alert( "Correo enviado a '.$to.'. '. $resultado[1] .'" );';
			echo 'window.location = "index.php"';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert( "Correo NO enviado a '.$to.'. '. $resultado[1] .'" );';
			echo 'window.location = "index.php"';
			echo '</script>';
		}
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "'. $resultado[1] .'" );';
		echo 'window.location = "registro.php"';
		echo '</script>';
	}
	
?>