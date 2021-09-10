<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" type="image/ico" href="img/icono.ico" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <!--<div class="loader-page"></div>-->
    <div class="contenedor">
    <h2>Programa que interpola con el método de Splines Cúbicos </h2>
    <h1>Método de Splines Cúbicos</h1>
            <h2>Métodos Numéricos</h2>
        </header>
        <section class="contenido">
            <form class="formulario" action="php/AproxMinCuadrados.php" method="post">
                <fieldset>
                    <legend style="text-align: center;">INGRESO DE DATOS:</legend>

                    <p>Los datos han sido seteados por un archivo txt, pulse enviar.</p>



                    <input class="boton" type="submit" value="Enviar" name="btnA">
                </fieldset>
            </form>
        </section>


        <footer style="text-align: left;">
            <h4>Julio Mora.</h4>
            <p>GR1COM</p>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
            $(window).on('load', function () {
                setTimeout(function () {
                $(".loader-page").css({visibility:"hidden",opacity:"0"})
                }, 2000);
            });
            function colocarPiA() {
                document.getElementById("a").value += "π";
            }

            function colocarPiB() {
                document.getElementById("b").value += "π";
            }
    </script>
</body>

</html>
