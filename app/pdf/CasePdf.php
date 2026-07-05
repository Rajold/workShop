<?php

require_once __DIR__ . '/../../libraries/fpdf/fpdf.php';

class CasePdf extends FPDF
{

    public function Header()
    {
        // Logo 
        $this->Image(
    __DIR__ . '/../../public/assets/img/logo.png',
    10,
    8,
    22
);

        // Nombre del taller
        
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, utf8_decode('
        DONDE LUPE
        '), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, utf8_decode('
   Sistema de Gestión del Taller
        '), 0, 1, 'C');

        // Eslogan
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, utf8_decode('Taller de motocicletas.'), 0, 1, 'C');

        $this->Ln(4);

        // Línea divisoria
        $this->SetDrawColor(180,180,180);
        $this->Line(10,30,200,30);

        $this->Ln(5);
    }

    public function Footer()
    {
        $this->SetY(-15);

        $this->SetFont('Arial','I',8);

        $this->SetTextColor(120);

        $this->Cell(
            0,
            10,
            utf8_decode('Página ') . $this->PageNo(),
            0,
            0,
            'C'
        );
    }

    protected function txt(string $texto): string
{
    return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
}

    public function titulo($texto)
{
    $this->SetFillColor(230,230,230);

    $this->SetFont('Arial','B',12);

    $this->Cell(
        0,
        8,
        utf8_decode($texto),
        0,
        1,
        'L',
        true
    );

    $this->Ln(2);
}

public function fila($etiqueta,$valor)
{
    $this->SetFont('Arial','B',10);
    $this->Cell(50,7,utf8_decode($etiqueta),0,0);

    $this->SetFont('Arial','',10);
    $this->Cell(0,7,utf8_decode($valor),0,1);
}

public function tablaDosColumnas(array $filas)
{
    foreach ($filas as $titulo => $valor) {

        // Columna izquierda
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(
            55,
            8,
            $this->txt($titulo),
            1,
            0,
            'L'
        );

        // Columna derecha
        $this->SetFont('Arial', '', 10);
        $this->Cell(
            135,
            8,
            $this->txt((string)$valor),
            1,
            1,
            'L'
        );
    }

    $this->Ln(3);
}

public function generate(
    array $caso,
    array $avances,
    array $totales
)
{
    $this->AddPage();

    //==============================
    // DATOS DEL VEHÍCULO
    //==============================

  $this->titulo("DATOS DEL VEHÍCULO");

$this->tablaDosColumnas([
    'Placa'  => $caso['placa'],
    'Marca'  => $caso['marca'],
    'Modelo' => $caso['modelo'],
    'Color'  => $caso['color']
]);

    $this->Ln(4);

    //==============================
    // CLIENTE
    //==============================

    $this->titulo("CLIENTE");

$this->tablaDosColumnas([
    'Propietario' => $caso['propietario']
]);

    $this->Ln(4);

    //==============================
    // CASO
    //==============================

   $this->titulo("INFORMACIÓN DEL CASO");

$this->tablaDosColumnas([
    'Caso'     => '#' . $caso['id'],
    'Estado'   => ucfirst($caso['estado']),
    'Mecánico' => $caso['mecanico_nombre']
]);

    $this->Ln(4);

    //==============================
    // CAUSA
    //==============================

    $this->titulo("CAUSA REPORTADA");

    $this->Ln(4);

$this->titulo("TRABAJOS REALIZADOS");

$this->SetFont('Arial','',10);

foreach ($avances as $avance) {

    $texto = sprintf(
        "[%s] %s - %s",
        date('d/m/Y', strtotime($avance['fecha'])),
        $avance['tipo'],
        $avance['descripcion']
    );

    $this->MultiCell(0, 6, $texto);

    if ($avance['valor'] > 0) {

        $this->SetFont('Arial','I',9);

        $this->Cell(
            0,
            5,
            '$ ' . number_format($avance['valor'],0,',','.'),
            0,
            1,
            'R'
        );

        $this->SetFont('Arial','',10);
    }

    $this->Ln(2);
}

$this->titulo("RESUMEN ECONÓMICO");

$this->tablaDosColumnas([
    'Mano de obra'    => $this->dinero($totales['mano_obra']),
    'Repuestos'       => $this->dinero($totales['repuestos']),
    'Total registrado'=> $this->dinero($totales['total']),
    'Precio cobrado'  => $this->dinero($caso['precio_cobrado']),
    'Descuento'       => $this->dinero($caso['descuento']),
    'Total facturado' => $this->dinero(
        $caso['precio_cobrado'] - $caso['descuento']
    )
]);




    $this->SetFont('Arial','',10);

    $this->MultiCell(
        0,
        6,
        $caso['causa']
    );

    $this->Ln(4);

    $this->Output(
        'I',
        "Caso_" . $caso['id'] . ".pdf"
    );
}

public function dinero($valor): string
{
    return '$ ' . number_format((float)$valor, 0, ',', '.');
}
}