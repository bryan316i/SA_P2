<?php
require_once("lib/nusoap.php");

class Admon implements Serializable{
	//atributos
	public $usuarioActual;
	public $idCuentaActual;
	public $client;
	public static $connectionString = "http://25.126.241.8/WebServices/server.php";
	public $listaDocIdentificacion, $listaTipoPrestamo, $listaTipoSeguro, $listaBanco;
	
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
			//ve resultado
			return array( $resultado, $mensaje );
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
	public function getNombreCompleto(){
		return $this->nombre . ' ' . $this->apellido;
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
	
	function __construct(){
	}
	public function crear( $montoInicial ){
		return true;
	}
}

/*OPERACIONES*/
class Prestamo{
	//atributos
	public $id, $montoCuota, $totalPrestamo, $totalRecibir, $fechaRegistro, $autorizado, $fechaAutorizado, $tipoPrestamo;
	//metodos
	public function crear(){
		
		return true;
	}
	public function depositar(){
		return true;
	}
	public function debitar(){
		return true;
	}
	public function transferencia(){
		return true;
	}
	public function getHistorial(){
		return true;
	}
	public function refresh(){
		return true;
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