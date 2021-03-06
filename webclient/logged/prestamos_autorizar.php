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
                <li class="active"><a href="../">Inicio</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
	
    <div class="container">
	
	  <div class="row">
		<div class="col-lg-5 col-centered">
			<h4>Usuario: ADMINISTRADOR
			</h4>
		</div><!-- /.col-lg-4 -->
	  </div><!-- /.row -->
	  
	  <div class="row">
        <div class="col-lg-7 col-centered">
			<h2 class="sub-header">Préstamos sin autorizar</h2>
			  <div class="table-responsive">
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Préstamo</th>
					  <th>Total cuotas</th>
					  <th>Monto cuotas</th>
					  <th>Operación</th>
					</tr>
				  </thead>
				  <tbody>
<?php
	require_once( '../classes/Admon.php' );
	$admon = new Admon();
	$admon->actualizarPrestamosSinAutorizar();
	$admon->actualizarTiposPrestamo();
	$i = 1;
	if( isset( $admon->listaPrestamosSinAutorizar ) ){
		foreach( $admon->listaPrestamosSinAutorizar as $prestamo ){
			$tipoPrestamo = $admon->getTipoPrestamo( $prestamo->totalPrestamo );
			echo '<tr>';
			echo '<td>' . $i . '</td>';
			echo '<td>Q' . $prestamo->totalPrestamo . '</td>';
			echo '<td>' . $tipoPrestamo->cantidadCuotas . '</td>';
			echo '<td>Q' . $prestamo->montoCuota . '</td>';
			//autorizar
			echo '<form action="db_prestamos_autorizar.php" method="post" >';
			echo '<input type="hidden" name="idPrestamo" value="'.$prestamo->id.'"/>';
			echo '';
			echo '<td><button class="btn btn-lg btn-primary btn-block" type="submit">Autorizar</button></td>';
			echo '</form>';
			echo '</tr>';
			$i++;
		}
	}
?>
				  </tbody>
				</table>
			  </div>
		  </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

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
