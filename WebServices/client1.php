<?php 
print_r(getIdsDocumentoIdentificacion());

function getIdsDocumentoIdentificacion() {
	require 'confBD.php';

	$conn = oci_connect($userBD, $passBD, $ipBD);
	$stid = oci_parse($conn, 'select * from documentoidentificacion');
	oci_execute($stid);
	$resultado = array();
	$idsdocs = array();
	
	while (($row = oci_fetch_array($stid)) != false) {		
		if ($row['IDDOCUMENTOIDENTIFICACION'] !== null){
			$total++;
			$idsdocs[] = $row['IDDOCUMENTOIDENTIFICACION'];
		}
	}
	$resultado[] = $total;
	$resultado[] = $idsdocs;
	return $resultado;
}
?> 
