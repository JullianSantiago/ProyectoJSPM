<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="js/pie.css" rel="stylesheet">
</head>

<body>
    <header>
        <!--encabezado-->
        <?php include_once("include/encabezado.php") ?>
        <!--fin encabezado-->
    </header>

    <!--inicia el cuerpo de  la  página-->
    <div class="container" style="text-align: center;">
        <h2> !!! BIENVENIDOS !!</h2>
    </div>
    <!--termina  cuerpo de  la  pagina-->


    <!-- INICIA  CAROUSEL-->
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/fondo.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
                <div class="carousel-item">
                    <img src="img/fondo2.jpg" class="d-block w-100" alt="fondo2" width="400px" height="400px">
                </div>
                <div class=" carousel-item">
                    <img src="img/bufandas.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
                <div class=" carousel-item">
                    <img src="img/calcetas.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
                <div class=" carousel-item">
                    <img src="img/gorras.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
            </div>
            <button class=" carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- FIN  CAROUSEL-->



  <footer>
        <!-- inicia pie-->
    <?php include_once("include/pie.php") ?>
    <!--fin pie-->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>