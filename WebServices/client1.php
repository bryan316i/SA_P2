<?php 

print_r(addPagoPrestamo(2,5));

function addPagoPrestamo($idPrestamo, $idCuenta) {
	include 'confBD.php';
	$conn = oci_connect($userBD, $passBD, $ipBD);
	
	$stid = oci_parse($conn, 'SELECT montoCuota FROM prestamo WHERE idprestamo ='.$idPrestamo.' AND idEstado = 1 AND autorizado = 1');
	oci_execute($stid);
	if (($row = oci_fetch_array($stid)) != false) {	
		$monto = $row['MONTOCUOTA'];
	}	
	oci_free_statement($stid);

	echo $monto;
	if($monto > 0){

		$stid = oci_parse($conn, 'SELECT id_movimiento.nextval FROM dual');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$idMovimiento = $row['NEXTVAL'];
		}	
		oci_free_statement($stid);
		$saldoSuficiente = 0;
		$stid = oci_parse($conn, 'SELECT 1 FROM (SELECT getSaldo('.$idCuenta.')-'.$monto.' s FROM dual) WHERE s>0');
		oci_execute($stid);
		if (($row = oci_fetch_array($stid)) != false) {	
			$saldoSuficiente = $row['1'];
		}	
		oci_free_statement($stid);

		if($saldoSuficiente == 1){
			$stid = oci_parse($conn, 'INSERT INTO movimiento VALUES('.$idMovimiento.',  (SELECT sysdate FROM dual), '.$monto.', '.$idCuenta.', null, '.$idPrestamo.', null, 2, null, null)');	
		
			if(oci_execute($stid)){
				oci_free_statement($stid);
				$stid = oci_parse($conn, 'SELECT getSaldo('.$idCuenta.') s FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$saldo = $row['S'];
				}	
				oci_free_statement($stid);

				$stid = oci_parse($conn, 'SELECT getSaldoRestantePrestamo('.$idPrestamo.') restante FROM dual');
				oci_execute($stid);
				if (($row = oci_fetch_array($stid)) != false) {	
					$saldoRestante = $row['RESTANTE'];
				}	
				oci_free_statement($stid);
				if(!($saldoRestante > 0)){
					$stid = oci_parse($conn, 'UPDATE prestamo set idEstado = 2 where idPrestamo ='.$idPrestamo);
					oci_execute($stid);
					oci_free_statement($stid);
				}
				$resultado = 1;
				$mensaje = "Movimiento realizado. Correlativo: ".$idMovimiento;
		
			}else{
				$resultado = 2;
				$error = oci_error($stid);
				$mensaje = "Error: ". htmlentities($error['message'])."  ". htmlentities($error['sqltext']);
				oci_free_statement($stid);
			}
				
		}else{
			$resultado = 2;
			$mensaje = "Error: Saldo insuficiente";
			$saldo = -1;
		}
	}else{
		$resultado = 3;
		$mensaje = "Error: el prestamo ya se encuentra pagado totalmente";
	}
	oci_close($conn);
	return array('resultado'=>$resultado, 'mensaje'=>$mensaje, 'saldo'=>$saldo);
}

?> 
