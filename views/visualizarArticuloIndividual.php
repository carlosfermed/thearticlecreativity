<?php 
    session_start();    // REVISAR porque posiblemente pueda ser útil o no este método aquí.

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be creative</title>
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #DDD;
            /* background-color: #DDD; */
            background-image: url("public/img/newspaperbg.jpg");
            background-repeat: repeat;
            /* background-position: center; */
            background-size: cover;
            text-align: center;
        }

        div {
            display: block;
            margin: auto;
            border: 2px solid grey;
            border-radius: 30%;
            width: 400px;
            padding: 40px;
        }

        h1 {
            font-family: Script Normal;
            color: #555;            
        }

        #contenidoH4 {
            text-align: left;
        }        

        #etiquetaContenido {
            text-decoration: underline;
        }

        #derechos {
            font-size: 11px;
        }

        #botonVolverAtras {
            color: orange;
            background: grey;
            padding: 8px;
        }

        footer {
            background-color: #666;
            padding: 5px;
            text-align: center;
            color: #ddd;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
    <body>

    <?php 
        // Crear todo el contenido que mostrará los artículos de forma individual
        echo "<h1>" . $articuloIndividual->titulo . "</h1><br><hr><br>";
        echo "<div class='tarjeta'>";
        echo "<span id='etiquetaContenido'>Contenido del artículo/noticia<br></span><h4 id='contenidoH4'>" . $articuloIndividual->contenido . "</h4><br><br>";
        echo "<span>Fecha: </span><h4>" . $articuloIndividual->fecha . "</h4>";
        echo "<span>Creador: </span><h4>" . $articuloIndividual->usuarioCreador . "</h4>";
        echo "</div><br>";

        echo "<input type='button' value='Volver atrás' id='botonVolverAtras' onclick='window.history.back();'>";
    ?>
    </body>
</html>
<?php include 'templates/footer.php'; ?>