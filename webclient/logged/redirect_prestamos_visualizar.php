<?php
session_start();
if( strcmp( $_SESSION['banco'], "PHP" ) == 0 ){
	header('Location: prestamos_visualizar.php');
}elseif( strcmp( $_SESSION['banco'], "ASP" ) == 0 ){
	header('Location: ASP_prestamos_visualizar.php');
}else{
}
?>