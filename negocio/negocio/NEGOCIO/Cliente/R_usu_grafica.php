<?php
session_start();
include_once("../Servidor/conexion.php");

// Verifica que la conexión sea exitosa
if (!$conexion) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}

// Ejecución de la consulta y manejo de errores
$sql = "SELECT r.tipousu, COUNT(u.idtipo) as sum 
        FROM usuarios AS u 
        INNER JOIN tipousuarios AS r 
        ON u.idtipo = r.idtipo 
        GROUP BY u.idtipo";

$res = $conexion->query($sql);

if (!$res) {
    die("Error en la consulta SQL: " . $conexion->error);
}
?>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tipos de usuario', 'Cantidad por tipo'],
            <?php
                $rows = [];
                while ($fila = $res->fetch_assoc()) {
                    // Escapar valores de PHP para evitar problemas con comillas en JavaScript
                    $tipousu = htmlspecialchars($fila["tipousu"], ENT_QUOTES);
                    $rows[] = "['" . $tipousu . "'," . $fila["sum"] . "]";
                }
                echo implode(",", $rows);
            ?>
        ]);

        var options = {
            title: 'TIPOS DE USUARIOS',
            width: 600,
            height: 400,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>
</head>

<body>
    <header>
        <!--encabezado-->
        <?php include_once("include/encabezado.php") ?>
        <!--fin encabezado-->
    </header>

    <div id="chart_div"></div>
    <footer>
        <?php include_once("include/pie.php"); ?>
    </footer>

</body>

</html>