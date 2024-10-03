<?php
require_once("lib/fpdf/fpdf.php");

class PDF extends fpdf {
    // CABEZERA DE LA PAGINA
    function Header() {
        // Logotipo
        $this->image("img/logo.png", 10, 8, 33);
        // TIPO DE LETRA
        $this->setFont("Arial", 'B', 15);
        // movemos a la derecha
        $this->Cell(110);
        // Titulo
        $this->Cell(60, 10, 'Reporte de Usuarios Existentes', 0, 0, 'C');
        // Salto de linea
        $this->Ln(30);
        $this->SetTextColor(255, 255, 255); // Steel Blue
        $this->setFillColor(255, 255, 255); // Alice Blue
        $this->SetDrawColor(255, 255, 255); // Light Blue
        $this->Cell(15, 10, '', 1, 0, 'C', true); // Columna en blanco
        // Cambiar color de texto y fondo
        $this->SetTextColor(70, 130, 180); // Steel Blue
        $this->setFillColor(240, 248, 255); // Alice Blue
        $this->SetDrawColor(173, 216, 230); // Light Blue
        
        // Tipo de letra para encabezados
        $this->setFont("Arial", 'B', 12);
        
        // Encabezado de la tabla con relleno
      
        $this->Cell(30, 10, 'Nombre', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Apellido Paterno', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Apellido Materno', 1, 0, 'C', true);
        $this->Cell(100, 10, 'Correo', 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Teléfono'), 1, 0, 'C', true);
        
        // Salto de linea
        $this->Ln(10);
    }

    function Footer() {
        // TIPO DE LETRA
        $this->SetY(-15);
        $this->setFont("Arial", 'B', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

require("../Servidor/conexion.php");

$consulta = 'SELECT * FROM usuarios';
$resultado = mysqli_query($conexion, $consulta);
$pdf = new PDF('p');

// Referencia a la clase
$pdf->AddPage();
$pdf->setFont('Arial', 'B', 10);

// Datos de la tabla
while ($row = mysqli_fetch_assoc($resultado)) {
    // Establecer color de fondo blanco para la celda en blanco
    $pdf->setFillColor(255, 255, 255); // Blanco
    $pdf->SetTextColor(255, 255, 255); 
    $pdf->SetDrawColor(255, 255, 255); 
    $pdf->Cell(15, 10, '', 1, 0, 'C', true); // Columna en blanco


    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFillColor(255, 255, 255); 
    $pdf->SetDrawColor(0, 0, 0); 
    $pdf->Cell(30, 10, utf8_decode($row['NomUsu']), 1, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode($row['ApaUsu']), 1, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode($row['AmaUsu']), 1, 0, 'C', true);
    $pdf->Cell(100, 10, utf8_decode($row['Correo']), 1, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode($row['Telefono']), 1, 0, 'C', true);
    $pdf->Ln(10);
}

$pdf->Output();
?>
