<?php
session_start();
if( strcmp( $_SESSION['banco'], "PHP" ) == 0 ){
	header('Location: prestamo_solicitar_monto.php');
}elseif( strcmp( $_SESSION['banco'], "ASP" ) == 0 ){
	header('Location: ASP_prestamo_solicitar.php');
}else{
}
?>