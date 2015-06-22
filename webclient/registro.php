<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>BitBat</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

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
              <a class="navbar-brand" href="index.html">BitBat</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="index.html">Inicio</a></li>
				<li class="active"><a href="registro.php">Registro</a></li>
                <li><a href="acercade.html">Acerca de</a></li>
                <li><a href="contactanos.html">Contáctanos</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
	
    <div class="container">

      <form class="form-registro">
        <h2 class="form-registro-heading">Regístrate</h2>
        <label for="inputNombres" class="sr-only">Nombres</label>
		<input type="text" id="inputNombres" class="form-control" placeholder="Nombres" required autofocus>
		<label for="inputApellidos" class="sr-only">Apellidos</label>
		<input type="text" id="inputApellidos" class="form-control" placeholder="Apellidos" required>
		<label for="inputEmail" class="sr-only">Correo electrónico</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Correo electrónico" required>
		<label for="inputTelefono" class="sr-only">Teléfono</label>
		<input type="number" id="inputTelefono" class="form-control" placeholder="Teléfono" required>
		<label for="inputDireccion" class="sr-only">Dirección</label>
		<input type="text" id="inputDireccion" class="form-control" placeholder="Dirección" required>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
		<label for="inputConfirmarPassword" class="sr-only">Confirmar contraseña</label>
        <input type="password" id="inputConfirmarPassword" class="form-control" placeholder="Confirmar contraseña" required>
        <select class="form-control" id="inputDocIdentificacion">
			<option>DPI</option>
			<option>Licencia</option>
		</select>
		<input type="text" id="inputDocIdentificacion" class="form-control" placeholder="Documento de identificación" required>
		<label for="inputNumDocIdentificacion" class="sr-only">Documento de identificación</label>
		<input type="number" id="inputNumDocIdentificacion" class="form-control" placeholder="Número de documento" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>
      </form>

	  <footer>
        <p>&copy; 2015 Banco, BitBat &middot; <a href="#">Privacidad</a> &middot; <a href="#">Términos</a></p>
      </footer>
	  
    </div> <!-- /container -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
