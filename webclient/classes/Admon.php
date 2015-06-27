<?php
require_once("lib/nusoap.php");

class Admon implements Serializable{
	//atributos
	public $usuarioActual;
	public $idCuentaActual;
	public $client;
	public static $connectionString = "http://25.126.241.8/WebServices/server.php";
	//public static $connectionString = "http://192.168.1.55/WebServices/server.php";
	public $listaDocIdentificacion, $listaTipoPrestamo, $listaTipoSeguro, $listaBanco;
	//ESPECIAL
	public $listaPrestamoSinAutorizar;
	
	//metodos
	function __construct(){
		$this->idCuentaActual = 0;
		//$client = new nusoap_client( "http://localhost/nusoap/productlist.php" );
		//$connectionString = "http://localhost/SAP2/WebServices/server.php";
		//$connectionString = "http://25.126.241.8/WebServices/server.php";
	}
	public function actualizarOpciones(){
		actualizarDocsIdentif();
		actualizarTiposPrestamo();
		actualizarTiposSeguro();
		actualizarBancos();
	}
	public function actualizarDocsIdentif(){
		$client = new nusoap_client( Admon::$connectionString );
		//docs identificacion
		$result = $client->call( "getIdsDocumentoIdentificacion" );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada doc
				$info = $client->call( "getDocumentoIdentificacion", array( "id" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$doc = new DocIdentificacion( $id, $info['nombre'] );
					$this->listaDocIdentificacion[] = $doc;
				}
			}
		}
	}
	public function actualizarTiposPrestamo(){
		$client = new nusoap_client( Admon::$connectionString );
		//tipos de prestamo
		$result = $client->call( "getIdsTipoPrestamo" );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada prestamo
				$info = $client->call( "getTipoPrestamo", array( "id" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$prestamo = new TipoPrestamo( $id, $info['min'], $info['max'], $info['tasaInteres'], $info['cantidadCuotas'] );
					$this->listaTipoPrestamo[] = $prestamo;
				}
			}
		}
	}
	public function actualizarTiposSeguro(){
		$client = new nusoap_client( Admon::$connectionString );
		//tipos de seguro
		$result = $client->call( "getIdsTipoSeguro" );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada seguro
				$info = $client->call( "getTipoSeguro", array( "id" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$seguro = new TipoSeguro( $id, $info['nombre'], $info['descripcion'] );
					$this->listaTipoSeguro[] = $seguro;
				}
			}
		}
	}
	public function actualizarBancos(){
		$client = new nusoap_client( Admon::$connectionString );
		//bancos
		$result = $client->call( "getIdsBanco" );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada banco
				$info = $client->call( "getBanco", array( "id" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$banco = new Banco( $id, $info['nombre'], $info['direccionIP'], $info['puerto'] );
					$this->listaBanco[] = $banco;
				}
			}
		}
	}
	public function getTipoPrestamo( $monto ){
		foreach( $this->listaTipoPrestamo as $tipo ){
			if( $monto >= $tipo->min && $monto <= $tipo->max ){
				return $tipo;
			}
		}
		return null;
	}
	public function getTipoSeguro( $nombre ){
		foreach( $this->listaTipoSeguro as $tipo ){
			if( strcmp( $nombre, $tipo->nombre ) == 0 ){
				return $tipo;
			}
		}
		return null;
	}
	public function getBanco( $id ){
		foreach( $this->listaBanco as $banco ){
			if( $id == $banco->id ){
				return $banco;
			}
		}
		return null;
	}
	public function getDocIdentif( $nombre ){
		foreach( $this->listaDocIdentificacion as $doc ){
			if( strcmp( $nombre, $doc->nombre ) == 0 ){
				return $doc;
			}
		}
		return null;
	}
	public function login( $usuario, $pass ){
		$this->usuarioActual = new Usuario( $usuario );
		$this->usuarioActual->password = $pass;
		return $this->usuarioActual->login();
	}
	public function actualizarPrestamosSinAutorizar(){
		unset( $this->listaPrestamosSinAutorizar );
		$client = new nusoap_client( Admon::$connectionString );
		//prestamos sin autorizar
		$result = $client->call( "getIdsPrestamoSinAutorizar" );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada prestamo
				$info = $client->call( "getPrestamo", array( "id" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$prestamo = new Prestamo( $info['montoCuota'], $info['totalPrestamo'], $info['totalRecibir'], $info['idTipoPrestamo'] );
					$prestamo->id = $id;
					$this->listaPrestamosSinAutorizar[] = $prestamo;
				}
			}
		}
	}
	public function autorizarPrestamo( $idPrestamo ){
		$client = new nusoap_client( Admon::$connectionString );
		//prestamos sin autorizar
		$result = $client->call( "setAutorizarPrestamo", array( "id" => $idPrestamo ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			return array( $resultado, $mensaje );
		}
		return null;
	}
	//default
	public function serialize(){
        return serialize( get_object_vars($this) );
    }
    public function unserialize($data){
        $values = unserialize( $data );
        foreach ( $values as $key=>$value ){
            $this->$key = $value;
        }
    }
	//CONEXION
	public static function get( $string ){
		$client = new nusoap_client( $this->connectionString );
		$result = $client->call( $string );
		if( ! $client->fault && ! $client->getError() ){
			return $result;
		}
	}
}

class Usuario implements Serializable{
	//atributos
	public $id, $usuario, $password;
	public $nombre, $apellido, $telefono, $direccion, $email;
	public $cambiarPass, $fechaRegistro;
	public $idDocIdentificacion, $numDocIdentificacion;
	public $listaCuenta;
	
	//metodos
	function __construct( $usuario ){
		$this->usuario = $usuario;
	}
	public function crear(){
		$client = new nusoap_client( Admon::$connectionString );
		//guarda usuario
		$result = $client->call( "addUser", array( "nombre" => $this->nombre, "apellido" => $this->apellido , "telefono" => $this->telefono , "direccion" => $this->direccion , "idDocIdentificacion" => $this->idDocIdentificacion , "numDocIdentificacion" => $this->numDocIdentificacion , "email" => $this->email ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			$usr = $result['usuario'];
			$pass = $result['password'];
			//ve resultado
			return array( $resultado, $mensaje, $usr, $pass );
		}else{
			return array( 3, "ERRROR" ); //error
		}
	}
	public function login(){
		$client = new nusoap_client( Admon::$connectionString );
		//prueba login
		$result = $client->call( "login", array( "usuario" => $this->usuario, "password" => $this->password ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			//toma informacion
			$this->nombre = "USUARIO";
			//informacion del usuario
			$this->refresh();
			//ve resultado
			return array( $resultado, $mensaje );
		}else{
			return array( 5, "ERRROR" ); //error
		}
	}
	public function logout(){
		$client = new nusoap_client( Admon::$connectionString );
		//prueba login
		$result = $client->call( "logout", array( "usuario" => $this->usuario ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			//ve resultado
			return array( $resultado, $mensaje );
		}else{
			return array( 5, "ERRROR" ); //error
		}
	}
	public function refresh(){
		$client = new nusoap_client( Admon::$connectionString );
		$info = $client->call( "getInfoUsuario", array( "usuario" => $this->usuario ) );
		if( ! $client->fault && ! $client->getError() ){
			$this->id = $info['id'];
			$this->nombre = $info['nombre'];
			$this->apellido = $info['apellido'];
			$this->telefono = $info['telefono'];
			$this->direccion = $info['direccion'];
			$this->cambiarPass = $info['cambiarPass'];
			$this->fechaRegistro = $info['fechaRegistro'];
			$this->idDocIdentificacion = $info['idDocIdentificacion'];
			$this->numDocIdentificacion = $info['numDocIdentificacion'];
			$this->email = $info['email'];
		}
	}
	public function cambiarPassword(){
		$client = new nusoap_client( Admon::$connectionString );
		$result = $client->call( "setPassword", array( "usuario" => $this->usuario, "password" => $this->password ) );
		if( ! $client->fault && ! $client->getError() ){
			return $result['resultado'];
		}
		return 3;
	}
	public function getNombreCompleto(){
		return $this->nombre . ' ' . $this->apellido;
	}
	public function actualizarCuentas(){
		unset( $this->listaCuenta );
		$client = new nusoap_client( Admon::$connectionString );
		//cuentas
		$result = $client->call( "getIdsCuenta", array( "id" => $this->id, "usuario" => $this->usuario ) );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada cuenta
				$info = $client->call( "getCuenta", array( "id" => $id, "usuario" => $this->usuario ) );
				if( ! $client->fault && ! $client->getError() ){
					$cuenta = new Cuenta( $id, $info['fechaCreacion'], $info['saldo'] );
					$this->listaCuenta[] = $cuenta;
				}
			}
			return $cantidad;
		}
	}
	public function crearCuenta( $montoInicial ){
		$client = new nusoap_client( Admon::$connectionString );
		//crear cuenta
		$result = $client->call( "addCuenta", array( "usuario" => $this->usuario ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$id = $result['id'];
			$fechaCreacion = $result['fechaCreacion'];
			return array( $resultado, $id, $fechaCreacion );
		}
	}
	public function getCuenta( $numCuenta ){
		foreach ( $this->listaCuenta as $cuenta ){
			if( $numCuenta == $cuenta->id ){
				return $cuenta;
			}
		}
		return null;
	}
	//default
	public function serialize(){
        return serialize( get_object_vars($this) );
    }
    public function unserialize($data){
        $values = unserialize( $data );
        foreach ( $values as $key=>$value ){
            $this->$key = $value;
        }
    }
}

class Cuenta{
	public $id, $fechaCreacion;
	public $listaPrestamo, $listaSeguro, $historial;
	public $saldo;
	
	function __construct( $id, $fechaCreacion, $saldo ){
		$this->id = $id;
		$this->fechaCreacion = $fechaCreacion;
		$this->saldo = $saldo;
	}
	public function depositar( $usuario, $monto ){
		return $this->movimiento( $usuario, $monto, 1 );
	}
	public function retiro( $usuario, $monto ){
		return $this->movimiento( $usuario, $monto, 2 );
	}
	public function movimiento( $usuario, $monto, $operacion ){
		$client = new nusoap_client( Admon::$connectionString );
		//crear movimiento
		$result = $client->call( "addMovimientoLocal", array( "id" => $this->id, "usuario" => $usuario, "tipoOperacion" => $operacion, "monto" => $monto ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			$saldo = $result['saldo'];
			return array( $resultado, $mensaje, $saldo );
		}
	}
	public function transferencia( $usuario, $cuentaSecundaria, $monto, $operacion ){
		$client = new nusoap_client( Admon::$connectionString );
		//crear movimiento
		$result = $client->call( "addTransferenciaLocal", array( "id" => $this->id, "usuario" => $usuario, "idCuentaSecundaria" => $cuentaSecundaria, "tipoOperacion" => $operacion, "monto" => $monto ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			$saldo = $result['saldo'];
			return array( $resultado, $mensaje, $saldo );
		}
	}
	public function actualizarHistorial( $usuario ){
		unset( $this->historial );
		$client = new nusoap_client( Admon::$connectionString );
		//cuentas
		$result = $client->call( "getIdsMovimiento", array( "id" => $this->id, "usuario" => $usuario ) );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada movimiento
				$info = $client->call( "getMovimiento", array( "idCuenta" => $this->id, "idMovimiento" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$mov = new Movimiento( $id, $info['fecha'], $info['monto'], $info['tipo'], $info['idCuentaSecundaria'], $info['idBancoCuentaSecundaria'], $info['idPrestamo'], $info['idSeguro'] );
					$this->historial[] = $mov;
				}
			}
			return $cantidad;
		}
	}
	public function actualizarPrestamos( $usuario ){
		unset( $this->listaPrestamo );
		$client = new nusoap_client( Admon::$connectionString );
		//prestamos
		$result = $client->call( "getIdsPrestamoCuenta", array( "id" => $this->id, "usuario" => $usuario ) );
		if( ! $client->fault && ! $client->getError() ){
			$cantidad = $result['cantidad'];
			$ids = $result['array'];
			for( $i=0; $i<$cantidad; $i++ ){
				$id = $ids[$i];
				//informacion de cada prestamo
				$info = $client->call( "getPrestamo", array( "idPrestamo" => $id ) );
				if( ! $client->fault && ! $client->getError() ){
					$prestamo = new Prestamo( $info['montoCuota'], $info['totalPrestamo'], $info['totalRecibir'], $info['idTipoPrestamo'] );
					$prestamo->id = $id;
					$prestamo->fechaRegistro = $info['fechaRegistro'];
					$prestamo->autorizado = $info['autorizado'];
					$prestamo->fechaAutorizado = $info['fechaAutorizacion'];
					$this->listaPrestamo[] = $prestamo;
				}
			}
			return $cantidad;
		}
	}
	public function getEstadisticasPrestamo( $idPrestamo ){
		$cantidad = 0;
		$acumulado = 0.00;
		for( $i=0; $i<count( $this->historial ); $i++ ){
			$mov = $this->historial[$i];
			if( $mov->idPrestamo == $idPrestamo && $mov->entrada == 2 ){
				$cantidad++;
				$acumulado = $acumulado + $mov->monto;
			}
		}
		return array( $cantidad, $acumulado );
	}
	public function getPrestamo( $idPrestamo ){
		foreach ( $this->listaPrestamo as $prestamo ){
			if( $idPrestamo == $prestamo->id ){
				return $prestamo;
			}
		}
		return null;
	}
}

/*OPERACIONES*/
class Prestamo{
	//atributos
	public $id, $montoCuota, $totalPrestamo, $totalRecibir, $fechaRegistro, $autorizado, $fechaAutorizado, $idTipoPrestamo;
	//metodos
	function __construct( $montoCuota, $totalPrestamo, $totalRecibir, $idTipoPrestamo ){
		$this->montoCuota = $montoCuota;
		$this->totalPrestamo = $totalPrestamo;
		$this->totalRecibir = $totalRecibir;
		$this->idTipoPrestamo = $idTipoPrestamo;
	}
	public function crear( $idCuenta, $usuario ){
		$client = new nusoap_client( Admon::$connectionString );
		//crear prestamo
		$result = $client->call( "addPrestamo", array( "id" => $idCuenta, "usuario" => $usuario, "montoCuota" => $this->montoCuota, "totalPrestamo" => $this->totalPrestamo, "totalRecibir" => $this->totalRecibir, "idTipoPrestamo" => $this->idTipoPrestamo ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			return array( $resultado, $mensaje );
		}
		return true;
	}
	public function getAutorizado(){
		if( $this->autorizado == 1 ){
			return "Si";
		}else{
			return "No";
		}
	}
	public function pagar( $idCuenta ){
		$client = new nusoap_client( Admon::$connectionString );
		//crear pago de prestamo
		$result = $client->call( "addPagoPrestamo", array( "idPrestamo" => $this->id, "idCuenta" => $idCuenta ) );
		if( ! $client->fault && ! $client->getError() ){
			$resultado = $result['resultado'];
			$mensaje = $result['mensaje'];
			//$monto = $result['monto'];
			$monto = 0.00;
			return array( $resultado, $mensaje, $monto );
		}
		return false;
	}
}
class Movimiento{
	public $id, $fecha, $monto, $entrada, $idCuentaSecundaria, $idBancoCuentaSecundaria, $idPrestamo, $idSeguro;
	function __construct( $id, $fecha, $monto, $entrada, $idCuentaSecundaria, $idBancoCuentaSecundaria, $idPrestamo, $idSeguro ){
		$this->id = $id;
		$this->fecha = $fecha;
		$this->monto = $monto;
		$this->entrada = $entrada;
		$this->idCuentaSecundaria = $idCuentaSecundaria;
		$this->idBancoCuentaSecundaria = $idBancoCuentaSecundaria;
		$this->idPrestamo = $idPrestamo;
		$this->idSeguro = $idSeguro;
	}
	public function getTipo(){
		if( $this->entrada == 1 ){
			return "deposito";
		}else{
			return "retiro";
		}
	}
}

/*CATALOGOS*/
class DocIdentificacion{
	public $id, $nombre;
	function __construct( $id, $nombre ){
		$this->id = $id;
		$this->nombre = $nombre;
	}
}
class Banco{
	public $id, $nombre, $direccionIP, $puerto;
	function __construct( $id, $nombre, $direccionIP, $puerto ){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->direccionIP = $direccionIP;
		$this->puerto = $puerto;
	}
}
class TipoPrestamo{
	public $id, $min, $max, $tasaInteres, $cantidadCuotas;
	function __construct( $id, $min, $max, $tasaInteres, $cantidadCuotas ){
		$this->id = $id;
		$this->min = $min;
		$this->max = $max;
		$this->tasaInteres = $tasaInteres;
		$this->cantidadCuotas = $cantidadCuotas;
	}
}
class TipoSeguro{
	public $id, $nombre, $descripcion;
	function __construct( $id, $nombre, $descripcion ){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
	}
}
?>