<?php
require_once('../classes/Admon.php');
include_once('fpdf.php'); 

$numCuenta = $_POST['numCuenta'];

//obtener historial
session_start();
$admon = unserialize( $_SESSION['admon'] );
$admon->usuarioActual->actualizarCuentas();
$cuenta = $admon->usuarioActual->getCuenta( $numCuenta );
$cuenta->actualizarHistorial( $admon->usuarioActual->usuario );

//generar PDF
$pdf = new FPDF(); 
$pdf->AddPage(); 
$pdf->SetFont( 'Arial','B',16 );
$pdf->Image('logo.png',10,6,30);
$pdf->Ln(10);
$pdf->Cell( 40,10,'Banco BitBat' );
$pdf->Ln(10);
$pdf->Cell( 40,10,'Cuenta no. '.$numCuenta );
$pdf->Ln(10);
$pdf->Cell( 15,10,'No.' );
$pdf->Cell( 60,10,'Fecha' );
$pdf->Cell( 40,10,'Monto' );
$pdf->Cell( 40,10,'Tipo' );
	
for( $i=0; $i< count( $cuenta->historial ); $i++ ){
	$mov = $cuenta->historial[$i];
	$num = $i+1;
	$monto = 'Q'.round($mov->monto,2);
	$pdf->Ln(10);
	$pdf->Cell( 15,10, $num );
	$pdf->Cell( 60,10, $mov->fecha );
	$pdf->Cell( 40,10, $monto );
	$pdf->Cell( 40,10, $mov->getTipo() );
}

$pdf->Ln(10);
$pdf->Cell( 40,10, '--- Fin movimientos ---' );

$pdf->Output(); 

?>