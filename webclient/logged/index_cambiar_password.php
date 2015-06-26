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
<?php
require_once( '../classes/Admon.php' );
session_start();
if( isset( $_SESSION['admon'] ) ){
}else{
	//header( 'Location: ..');
}
?>
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
              <a class="navbar-brand" href="#">BitBat</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                
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
	echo unserialize($_SESSION['admon'])->usuarioActual->getNombreCompleto();
?>
			</h4>
		</div><!-- /.col-lg-4 -->
	  </div><!-- /.row -->
		
	  <form action="db_index_cambiar_password.php" method="post" >
        <h2 class="form-heading">Cambia tu contraseña</h2>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" required autofocus>
		<label for="inputPasswordSecure" class="sr-only">Password</label>
        <input type="password" id="inputPasswordSecure" name="passSecure" class="form-control" placeholder="Vuelve a ingresar tu contraseña" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Continuar</button>
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
