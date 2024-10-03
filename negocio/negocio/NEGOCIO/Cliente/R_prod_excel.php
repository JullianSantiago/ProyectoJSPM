<?php

require("../Servidor/conexion.php");

// Nombre del archivo y charset
header('Content-Type: text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="ReporteProductos.csv"');

// Salida del archivo
$salida = fopen('php://output', 'w');

// Encabezados del CSV
fputcsv($salida, array('ID Producto', 'Nombre', 'Descripción', 'Cantidad', 'Precio', 'Color', 'Tamaño', 'Foto', 'ID Categoría'));

// Consulta para obtener los datos de productos
$reporteCsv = mysqli_query($conexion, 'SELECT idprod, nombre, descripcion, cantidad, precio, color, tamanio, foto, idcat FROM productos');

// Verificar si la consulta fue exitosa
if (!$reporteCsv) {
    die("Error en la consulta: " . $conexion->error);
}

// Escribir los datos de los productos en el archivo CSV, incluyendo la ruta de la foto
while ($filaR = $reporteCsv->fetch_assoc()) {
    fputcsv($salida, array(
        $filaR['idprod'],
        $filaR['nombre'],
        $filaR['descripcion'],
        $filaR['cantidad'],
        $filaR['precio'],
        $filaR['color'],
        $filaR['tamanio'],
        $filaR['foto'], // Aquí se incluye la ruta o URL de la foto
        $filaR['idcat']
    ));
}

// Cerrar la salida
fclose($salida);
?>