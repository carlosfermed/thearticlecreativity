<?php 

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
        <header>        
            <h1>- The ARTiCLE CREATiViTY -</h1>
            <h4 id="usuario" style="color: orange;"><?= isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : "" ?></h4>
        </header>
        <nav>
            <a href=<?= isset($_SESSION["usuario"]) ? "/sesion" : "/" ?> class="movimientoi bordeNaranja">Volver 🢨</a>
        </nav>
        <?php 
            // Crear todo el contenido que mostrará los artículos de forma individual.
            echo "<h2>" . $articuloIndividual->titulo . "</h2><hr><br>";
            echo "<div class='tarjeta'>";
            echo "<span id='etiquetaContenido'>Descripción:<br></span><h4 id='contenidoH4'>" . $articuloIndividual->contenido . "</h4><br><br>";
            echo "<span>Fecha: </span><h4>" . $articuloIndividual->fecha . "</h4>";
            echo "<span>Creador: </span><h4>" . $articuloIndividual->usuarioCreador . "</h4>";
            echo "</div><br>";

            // Si el usuario ha iniciado sesión y el artículo fue creado por él.
            if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] == "$articuloIndividual->usuarioCreador") {
                echo "<form action='mostrarArticuloIndividual' method='post'>";
                echo "<input type='text' value='" . $articuloIndividual->id . "' name='idEditar' hidden>";
                echo "<input type='submit' value='Editar' id='botonEditarArticulo'>";
                echo "</form>";
                echo "<form action='eliminar' method='post'>";
                echo "<input type='text' value='" . $articuloIndividual->id . "' name='idEliminar' hidden>";
                echo "<input type='submit' value='Eliminar' id='botonEliminarArticulo' title='Precaución esta acción elimina el artículo definitivamente'>";
                echo "</form>";
            }                
        ?>
    </body>
</html>
<?php include 'templates/footer.php'; ?>