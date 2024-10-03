<?php
require_once("lib/fpdf/fpdf.php");

class PDF extends FPDF {
    // CABEZERA DE LA PÁGINA
    function Header() {
        // Logotipo
        $this->Image("img/logo.png", 10, 8, 33);
        // TIPO DE LETRA
        $this->SetFont("Arial", 'B', 15);
        // Movemos a la derecha
        $this->Cell(110);
        // Título
        $this->Cell(60, 10, 'Reporte de Productos', 0, 0, 'C');
        // Salto de línea
        $this->Ln(30);
        $this->SetTextColor(255, 255, 255); // Steel Blue
        $this->setFillColor(255, 255, 255); // Alice Blue
        $this->SetDrawColor(255, 255, 255); // Light Blue
        $this->Cell(15, 10, '', 1, 0, 'C', true); // Columna en blanco
        // Cambiar color de texto y fondo para la tabla
        $this->SetTextColor(255, 255, 255); // Texto blanco
        $this->SetFillColor(70, 130, 180); // Azul acero
        $this->SetDrawColor(70, 130, 180); // Azul acero

        // Tipo de letra para encabezados
        $this->SetFont("Arial", 'B', 12);

        // Encabezado de la tabla
        $this->Cell(15, 10, 'ID', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Nombre', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Descripcion', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(25, 10, 'Precio', 1, 0, 'C', true);
        $this->Cell(25, 10, 'Color', 1, 0, 'C', true);
        $this->Cell(25, 10, utf8_decode('Tamaño'), 1, 0, 'C', true);
        $this->Cell(30, 10, 'Foto', 1, 0, 'C', true); // Columna para la imagen
        $this->Cell(20, 10, 'ID Cat', 1, 0, 'C', true);

        // Salto de línea
        $this->Ln(10);
    }

    // PIE DE PÁGINA
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Tipo de letra
        $this->SetFont("Arial", 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

require("../Servidor/conexion.php");

// Consulta para obtener los productos
$consulta = 'SELECT idprod, nombre, descripcion, cantidad, precio, color, tamanio, foto, idcat FROM productos';
$resultado = mysqli_query($conexion, $consulta);

// Crear el PDF
$pdf = new PDF('L'); // Cambiamos 'L' a 'P' para orientación vertical
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10); // Tipo de letra para las celdas de datos

// Mostrar los datos de la tabla
while ($row = mysqli_fetch_assoc($resultado)) {


    $pdf->setFillColor(255, 255, 255); // Blanco
    $pdf->SetTextColor(255, 255, 255); 
    $pdf->SetDrawColor(255, 255, 255); 
    $pdf->Cell(15, 10, '', 1, 0, 'C', true); // Columna en blanco
    // Color de fondo blanco para las filas
    $pdf->SetFillColor(255, 255, 255); 
    $pdf->SetTextColor(0, 0, 0); // Texto negro
    $pdf->SetDrawColor(0, 0, 0); // Bordes negros

    // Celdas con los datos

    $pdf->Cell(15, 10, utf8_decode($row['idprod']), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode($row['nombre']), 1, 0, 'C', true);
    $pdf->Cell(50, 10, utf8_decode($row['descripcion']), 1, 0, 'C', true);
    $pdf->Cell(20, 10, utf8_decode($row['cantidad']), 1, 0, 'C', true);
    $pdf->Cell(25, 10, utf8_decode($row['precio']), 1, 0, 'C', true);
    $pdf->Cell(25, 10, utf8_decode($row['color']), 1, 0, 'C', true);
    $pdf->Cell(25, 10, utf8_decode($row['tamanio']), 1, 0, 'C', true);

    // Mostrar la imagen si existe
    if (!empty($row['foto']) && file_exists($row['foto'])) {
        $pdf->Cell(30, 30, $pdf->Image($row['foto'], $pdf->GetX(), $pdf->GetY(), 10, 10), 1, 0, 'C'); // Tamaño de imagen ajustado (20x20)
    } else {
        $pdf->Cell(30, 10, 'Sin Foto', 1, 0, 'C', true);
    }

    $pdf->Cell(20, 10, utf8_decode($row['idcat']), 1, 0, 'C', true);

    // Salto de línea después de cada fila
    $pdf->Ln(10); // Ajusta la altura de la fila
}

// Salida del archivo PDF
$pdf->Output();
?>
