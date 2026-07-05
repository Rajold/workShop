<?php

require_once __DIR__ . '/../libraries/fpdf/fpdf.php';

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0,10,'Hola desde Taller Donde Lupe');

$pdf->Output();