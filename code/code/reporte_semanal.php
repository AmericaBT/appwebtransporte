<?php
require __DIR__ . '/fpdf/fpdf.php';
include __DIR__ . '/conexion.php';

// -------------------------------------
// OBTENER FECHAS DE ESTA SEMANA
// -------------------------------------
$inicioSemana = date("Y-m-d", strtotime("monday this week"));
$finSemana = date("Y-m-d", strtotime("sunday this week"));

// -------------------------------------
// CONSULTA PAGOS DE LA SEMANA ACTUAL
// -------------------------------------
$sql = "SELECT * FROM pagos 
        WHERE fecha_pago BETWEEN '$inicioSemana' AND '$finSemana'
        ORDER BY fecha_pago ASC";

$resultado = $conexion->query($sql);

// -------------------------------------
// CREAR PDF
// -------------------------------------
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, 'Reporte Semanal de Pagos', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, "Semana: $inicioSemana a $finSemana", 0, 1, 'C');

$pdf->Ln(5);

// ENCABEZADOS DE TABLA
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 8, 'ID', 1);
$pdf->Cell(50, 8, 'Nombre', 1);
$pdf->Cell(50, 8, 'Apellidos', 1);
$pdf->Cell(30, 8, 'Ingreso', 1);
$pdf->Cell(40, 8, 'Fecha', 1);
$pdf->Ln();

// FILAS
$pdf->SetFont('Arial', '', 10);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(20, 8, $fila['id_pago'], 1);
        $pdf->Cell(50, 8, utf8_decode($fila['nombre']), 1);
        $pdf->Cell(50, 8, utf8_decode($fila['apellidos']), 1);
        $pdf->Cell(30, 8, "$" . number_format($fila['ingreso'], 2), 1);
        $pdf->Cell(40, 8, $fila['fecha_pago'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay pagos registrados esta semana.', 1, 1, 'C');
}

// MOSTRAR PDF
$pdf->Output();
exit;
?>
