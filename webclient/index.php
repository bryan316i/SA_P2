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
              <a class="navbar-brand" href="index.php">BitBat</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio</a></li>
				<li><a href="registro.php">Registro</a></li>
                <li><a href="acercade.html">Acerca de</a></li>
                <li><a href="contactanos.html">Contáctanos</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
	
	
    <div class="container">
	
		<div class="jumbotron">
		  <div class="container">
			<h1>Bienvenido!</h1>
			<p class="lead">Estamos para hacerte crecer. Mediante el crecimiento económico de día a día hacemos de nuestra organización un lugar mejor para que guardes tu dinero.<br> Cuidamos de ti.</p>
		  </div>
		</div>
		
      <form class="form-signin" action="db_login.php" method="post" >
        <h2 class="form-signin-heading">Inicia sesión</h2>
        <label for="inputUsuario" class="sr-only">Usuario</label>
        <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required>
		<p>Banco: </p>
		<select class="form-control" id="inputBanco" name="banco">
			<option>PHP</option>
			<option>Java</option>
			<option>ASP</option>
		</select>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
      </form>

	  <footer>
        <p>&copy; 2015 Banco, BitBat &middot; <a href="#">Privacidad</a> &middot; <a href="#">Términos</a> &middot; <a href="logged/prestamos_autorizar.php">Autorización de préstamos</a></p>
      </footer>
	  
    </div> <!-- /container -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
