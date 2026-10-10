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
   Taller de motocicletas.
        '), 0, 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, utf8_decode('Reporte de procedimientos realizados'), 0, 1, 'C');

        $this->Ln(4);

        // división
        $this->SetDrawColor(180, 180, 180);
        $this->Line(10, 30, 200, 30);

        $this->Ln(5);
    }

    public function Footer()
    {
        $this->SetY(-15);

        $this->SetFont('Arial', 'I', 8);

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
        $this->SetFillColor(230, 230, 230);

        $this->SetFont('Arial', 'B', 12);

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

    public function fila($etiqueta, $valor)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(50, 7, utf8_decode($etiqueta), 0, 0);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 7, utf8_decode($valor), 0, 1);
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
        array $totales,
        array $caseParts = [],
        array $casePurchases = []
    ) {
        $this->AddPage();

        // DATOS DEL VEHÍCULO

        $this->titulo("DATOS DEL VEHÍCULO");

        $this->tablaDosColumnas([
            'Placa'  => $caso['placa'],
            'Marca'  => $caso['marca'],
            'Modelo' => $caso['modelo']
        ]);

        $this->Ln(4);

        // CLIENTE
        $this->titulo("CLIENTE");

        $this->tablaDosColumnas([
            'Propietario' => $caso['propietario']
        ]);

        $this->Ln(4);

        // CASO

        $this->titulo("INFORMACIÓN DEL CASO");

        $this->tablaDosColumnas([
            'Caso'     => '#' . $caso['id'],
            'Estado'   => ucfirst($caso['estado']),
            'Mecánico' => $caso['mecanico_nombre']
        ]);

        $this->Ln(4);

        // // CAUSA

        // $this->titulo("CAUSA REPORTADA");
        // $this->SetFont('Arial','',10);

        // $this->MultiCell(
        //     0,
        //     6,
        //     $caso['causa']
        // );

        // $this->Ln(4);

      $this->titulo("TRABAJOS REALIZADOS");

// Anchos de columnas: total 190 mm
$anchoFecha = 25;
$anchoTipo = 35;
$anchoDescripcion = 100;
$anchoValor = 30;

// Encabezados
$this->SetFont('Arial', 'B', 9);

$this->Cell($anchoFecha, 8, $this->txt('Fecha'), 1, 0, 'C');
$this->Cell($anchoTipo, 8, $this->txt('Tipo'), 1, 0, 'L');
$this->Cell($anchoDescripcion, 8, $this->txt('Descripción'), 1, 0, 'L');
$this->Cell($anchoValor, 8, $this->txt('Valor'), 1, 1, 'R');

if (empty($avances)) {
    $this->SetFont('Arial', 'I', 9);
    $this->Cell(
        190,
        8,
        $this->txt('No hay trabajos registrados.'),
        1,
        1,
        'C'
    );
} else {
    $this->SetFont('Arial', '', 9);

    foreach ($avances as $avance) {
        $fecha = !empty($avance['fecha'])
            ? date('d/m/Y', strtotime($avance['fecha']))
            : '-';

        $tipo = (string)($avance['tipo'] ?? '-');
        $descripcion = (string)($avance['descripcion'] ?? '');
        $valor = (float)($avance['valor'] ?? 0);

        // Altura necesaria para la descripción
        $lineasDescripcion = max(
            1,
            (int)ceil(
                $this->GetStringWidth($this->txt($descripcion))
                / ($anchoDescripcion - 2)
            )
        );

        $altura = max(8, $lineasDescripcion * 5);

        // Evitar que la fila se salga de la página
        if ($this->GetY() + $altura > $this->GetPageHeight() - 20) {
            $this->AddPage();

            $this->SetFont('Arial', 'B', 9);
            $this->Cell($anchoFecha, 8, $this->txt('Fecha'), 1, 0, 'C');
            $this->Cell($anchoTipo, 8, $this->txt('Tipo'), 1, 0, 'L');
            $this->Cell($anchoDescripcion, 8, $this->txt('Descripción'), 1, 0, 'L');
            $this->Cell($anchoValor, 8, $this->txt('Valor'), 1, 1, 'R');

            $this->SetFont('Arial', '', 9);
        }

        $x = $this->GetX();
        $y = $this->GetY();

        // Fecha
        $this->Cell($anchoFecha, $altura, $this->txt($fecha), 1, 0, 'C');

        // Tipo
        $this->Cell($anchoTipo, $altura, $this->txt($tipo), 1, 0, 'L');

        // Descripción con ajuste de línea
        $xDescripcion = $this->GetX();
        $this->Rect($xDescripcion, $y, $anchoDescripcion, $altura);

        $this->SetXY($xDescripcion + 1, $y + 1);
        $this->MultiCell(
            $anchoDescripcion - 2,
            5,
            $this->txt($descripcion),
            0,
            'L'
        );

        // Valor
        $this->SetXY($x + $anchoFecha + $anchoTipo + $anchoDescripcion, $y);
        $this->Cell(
            $anchoValor,
            $altura,
            $this->dinero($valor),
            1,
            1,
            'R'
        );
    }
}

$this->Ln(3);


       // REPUESTOS UTILIZADOS
        // Mostrar la sección únicamente si existen repuestos

        if (!empty($caseParts)) {

            $this->titulo("REPUESTOS UTILIZADOS");

            // Anchos de columnas: total 190 mm
            $anchoFecha = 25;
            $anchoRepuesto = 65;
            $anchoCantidad = 20;
            $anchoPrecio = 40;
            $anchoSubtotal = 40;

            // Encabezados
            $this->SetFont('Arial', 'B', 9);

            $this->Cell(
                $anchoFecha,
                8,
                $this->txt('Fecha'),
                1,
                0,
                'C'
            );

            $this->Cell(
                $anchoRepuesto,
                8,
                $this->txt('Repuesto'),
                1,
                0,
                'L'
            );

            $this->Cell(
                $anchoCantidad,
                8,
                $this->txt('Cant.'),
                1,
                0,
                'C'
            );

            $this->Cell(
                $anchoPrecio,
                8,
                $this->txt('Precio unit.'),
                1,
                0,
                'R'
            );

            $this->Cell(
                $anchoSubtotal,
                8,
                $this->txt('Subtotal'),
                1,
                1,
                'R'
            );

            $this->SetFont('Arial', '', 9);

            foreach ($caseParts as $repuesto) {

                // Fecha de registro del repuesto en el caso
                $fecha = !empty($repuesto['created_at'])
                    ? date('d/m/Y', strtotime($repuesto['created_at']))
                    : '-';

                // Nombre y marca
                $nombre = (string)($repuesto['nombre'] ?? '');

                if (!empty($repuesto['marca'])) {
                    $nombre .= ' - ' . $repuesto['marca'];
                }

                // Cantidad
                $cantidad = number_format(
                    (float)$repuesto['cantidad'],
                    2,
                    ',',
                    '.'
                );

                // Precios
                $precio = $this->dinero(
                    $repuesto['precio_unitario'] ?? 0
                );

                $subtotal = $this->dinero(
                    $repuesto['subtotal'] ?? 0
                );

                // Calcular altura aproximada según longitud del nombre
                $lineasNombre = max(
                    1,
                    (int)ceil(
                        $this->GetStringWidth($this->txt($nombre))
                        / ($anchoRepuesto - 2)
                    )
                );

                $altura = max(8, $lineasNombre * 5);

                // Comprobar si la fila cabe en la página actual
                if (
                    $this->GetY() + $altura >
                    $this->GetPageHeight() - 20
                ) {

                    $this->AddPage();

                    // Repetir encabezados en la nueva página
                    $this->SetFont('Arial', 'B', 9);

                    $this->Cell(
                        $anchoFecha,
                        8,
                        $this->txt('Fecha'),
                        1,
                        0,
                        'C'
                    );

                    $this->Cell(
                        $anchoRepuesto,
                        8,
                        $this->txt('Repuesto'),
                        1,
                        0,
                        'L'
                    );

                    $this->Cell(
                        $anchoCantidad,
                        8,
                        $this->txt('Cant.'),
                        1,
                        0,
                        'C'
                    );

                    $this->Cell(
                        $anchoPrecio,
                        8,
                        $this->txt('Precio unit.'),
                        1,
                        0,
                        'R'
                    );

                    $this->Cell(
                        $anchoSubtotal,
                        8,
                        $this->txt('Subtotal'),
                        1,
                        1,
                        'R'
                    );

                    $this->SetFont('Arial', '', 9);
                }

                $x = $this->GetX();
                $y = $this->GetY();

                // Fecha
                $this->Cell(
                    $anchoFecha,
                    $altura,
                    $this->txt($fecha),
                    1,
                    0,
                    'C'
                );

                // Nombre del repuesto con ajuste de línea
                $xRepuesto = $this->GetX();

                $this->Rect(
                    $xRepuesto,
                    $y,
                    $anchoRepuesto,
                    $altura
                );

                $this->SetXY(
                    $xRepuesto + 1,
                    $y + 1
                );

                $this->MultiCell(
                    $anchoRepuesto - 2,
                    5,
                    $this->txt($nombre),
                    0,
                    'L'
                );

                // Cantidad
                $this->SetXY(
                    $x + $anchoFecha + $anchoRepuesto,
                    $y
                );

                $this->Cell(
                    $anchoCantidad,
                    $altura,
                    $cantidad,
                    1,
                    0,
                    'C'
                );

                // Precio unitario
                $this->Cell(
                    $anchoPrecio,
                    $altura,
                    $precio,
                    1,
                    0,
                    'R'
                );

                // Subtotal
                $this->Cell(
                    $anchoSubtotal,
                    $altura,
                    $subtotal,
                    1,
                    1,
                    'R'
                );
            }

            $this->Ln(3);
        }

        // COMPRAS DIRECTAS

        if (!empty($casePurchases)) {

            $this->titulo("COMPRAS DIRECTAS");

            $this->SetFont('Arial', 'B', 9);

            $this->Cell(
                75,
                8,
                $this->txt('Descripción'),
                1,
                0,
                'L'
            );

            $this->Cell(
                20,
                8,
                $this->txt('Cant.'),
                1,
                0,
                'C'
            );

            $this->Cell(
                40,
                8,
                $this->txt('Precio unit.'),
                1,
                0,
                'R'
            );

            $this->Cell(
                45,
                8,
                $this->txt('Subtotal'),
                1,
                1,
                'R'
            );

            $this->SetFont('Arial', '', 9);

            foreach ($casePurchases as $purchase) {

                $this->Cell(
                    75,
                    8,
                    $this->txt($purchase['descripcion']),
                    1,
                    0,
                    'L'
                );

                $this->Cell(
                    20,
                    8,
                    number_format(
                        (float)$purchase['cantidad'],
                        0,
                        ',',
                        '.'
                    ),
                    1,
                    0,
                    'C'
                );

                $this->Cell(
                    40,
                    8,
                    $this->dinero($purchase['precio_unitario']),
                    1,
                    0,
                    'R'
                );

                $this->Cell(
                    45,
                    8,
                    $this->dinero($purchase['subtotal']),
                    1,
                    1,
                    'R'
                );
            }

            $this->Ln(3);
        }

        // RESUMEN DEL SERVICIO

        $this->titulo("RESUMEN DEL SERVICIO");

        if (($caso['estado'] ?? '') === 'cerrado') {

            $precioCobrado = (float)($caso['precio_cobrado'] ?? 0);
            $descuento = (float)($caso['descuento'] ?? 0);

            $totalCobrado = max(
                0,
                $precioCobrado - $descuento
            );

            $this->tablaDosColumnas([
                'Total cobrado' => $this->dinero($totalCobrado)
            ]);
        } else {

            $ventaRepuestos = (float)$totales['repuestos'];

            $ventaComprasDirectas = 0;

            foreach ($casePurchases as $purchase) {
                $ventaComprasDirectas += (float)$purchase['subtotal'];
            }

            $totalServicio =
                (float)$totales['mano_obra'] +
                $ventaRepuestos +
                $ventaComprasDirectas;

            $this->tablaDosColumnas([
                'Mano de obra' => $this->dinero($totales['mano_obra']),

                'Repuestos' => $this->dinero(
                    $ventaRepuestos + $ventaComprasDirectas
                ),

                'Total del servicio' => $this->dinero($totalServicio)
            ]);
        }

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
