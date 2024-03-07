<?php 
    session_start();

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
    <link rel="stylesheet" type="text/css" href="public/css/estiloArticuloIndividual.css">
</head>
    <body>
        <?php 
            // Crear todo el contenido que mostrará los artículos de forma individual.
            echo "<h1>" . $articuloIndividual->titulo . "</h1><br><hr><br>";
            echo "<div class='tarjeta'>";
            echo "<span id='etiquetaContenido'>Contenido del artículo/noticia<br></span><h4 id='contenidoH4'>" . $articuloIndividual->contenido . "</h4><br><br>";
            echo "<span>Fecha: </span><h4>" . $articuloIndividual->fecha . "</h4>";
            echo "<span>Creador: </span><h4>" . $articuloIndividual->usuarioCreador . "</h4>";
            echo "</div><br>";

            echo "<input type='button' value='Volver atrás' id='botonVolverAtras' onclick='window.history.back();'>";
            if ($_SESSION["usuario"] == "$articuloIndividual->usuarioCreador") {
                echo "<form action='eliminar' method='post'>";
                echo "<input type='text' value='" . $articuloIndividual->id . "' name='idEliminar' hidden>";
                echo "<input type='submit' value='Eliminar Artículo' id='botonEliminarArticulo' title='Precaución esta acción elimina el artículo definitivamente'>";
                echo "</form>";
            }                
        ?>
    </body>
</html>
<?php include 'templates/footer.php'; ?>