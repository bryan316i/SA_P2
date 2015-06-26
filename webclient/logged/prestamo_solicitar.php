<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>BitBat</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<?php
require_once( '../classes/Admon.php' );
session_start();
if( isset( $_SESSION['admon'] ) ){
}else{
	header( 'Location: ..');
}
?>
  <body>

      <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">BitBat</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio</a></li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cuentas <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="cuenta_crear.php">Crear</a></li>
                    <li><a href="cuentas_visualizar.php">Visualizar</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Movimientos</li>
                    <li><a href="cuenta_deposito.php">Depósito</a></li>
                    <li><a href="cuenta_retiro.php">Retiro</a></li>
					<li><a href="cuenta_transferencia.php">Transferencia</a></li>
                  </ul>
                </li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Seguros <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="seguro_contratar_seleccion.php">Contratar</a></li>
                    <li><a href="seguro_pagar_seleccion_cuenta.php">Realizar pago</a></li>
					<li><a href="seguros_visualizar.php">Visualizar</a></li>
                  </ul>
                </li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Préstamos <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="prestamo_solicitar_monto.php">Solicitar</a></li>
                    <li><a href="prestamo_pagar.php">Realizar pago</a></li>
					<li><a href="prestamos_visualizar.php">Visualizar</a></li>
                  </ul>
                </li>
				<li><a href="db_logout.php">Cerrar sesión</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
	
	<div class="container">
	
	  <div class="row">
		<div class="col-lg-5 col-centered">
			<h4>Usuario: 
<?php
	echo unserialize($_SESSION['admon'])->usuarioActual->nombre;
?>
			</h4>
		</div><!-- /.col-lg-4 -->
	  </div><!-- /.row -->
		
	  <form>
        <h2 class="form-heading">Solicita un préstamo</h2>
<?php
	require_once('../classes/Admon.php');
	$monto = $_POST['monto'];
if( $monto < 5000 ){
	//mensaje y redirigir
	echo '<script language="javascript">';
	echo 'alert( "No brindamos préstamos menores a Q 5,000.00" );';
	echo 'window.location = "prestamo_solicitar_monto.php"';
	echo '</script>';
}else{
	//mostrar informacion
	$admon = unserialize( $_SESSION['admon'] );
	$admon->actualizarTiposPrestamo();
	$prestamo = $admon->getTipoPrestamo( $monto );
	if( $prestamo != null ){
		$total = $monto*(1+$prestamo->tasaInteres/100);
		$cuota = round( $total / $prestamo->cantidadCuotas, 2 );
		//mostrar informacion
		echo '<p>Solicitado: Q' . $monto . '</p>';
		echo '<input type="hidden" name="monto" value="'.$monto.'">';
		echo '<p>Rango: Q' . $prestamo->min . ' a Q' . $prestamo->max . '</p>';
		echo '<p>Total préstamo: Q' . $total . '</p>';
		echo '<p>Tasa: ' . $prestamo->tasaInteres . '%</p>';
		echo '<p>Cuotas: ' . $prestamo->cantidadCuotas . ' cuotas de Q' . $cuota . ' cada una</p>';
	}else{
		//mensaje y redirigir
		echo '<script language="javascript">';
		echo 'alert( "No brindamos actualmente tal prestamo" );';
		echo 'window.location = "prestamo_solicitar_monto.php"';
		echo '</script>';
	}
}
?>
		<p>Selecciona tu cuenta de asociación:</p>
		<select class="form-control" id="inputNumCuenta" required autofocus>
			<option>5522215</option>
			<option>5522216</option>
		</select>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Solicitar</button>
      </form>

	  <footer>
        <p>&copy; 2015 Banco, BitBat &middot; <a href="#">Privacidad</a> &middot; <a href="#">Términos</a></p>
      </footer>
	  
    </div> <!-- /container -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
