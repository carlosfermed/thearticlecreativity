<?php

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

    $redireccionamiento = "sesion";    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be creative</title>
    <link rel="stylesheet" type="text/css" href="public/css/estiloGenerico.css">
</head>
<body>
    <header>        
        <!-- Título interactivo -->
        <h1>- <span class="titulo cambioTamanio"><span class="letraT espacio">T</span><span class="espacio">h</span><span class="espacio">e</span>
        <span class="espacio">A</span><span class="espacio">R</span><span class="letraT espacio">T</span><span class="letrai espacio">i</span><span class="espacio">C</span><span class="espacio">L</span><span class="espacio">E</span>
        <span class="espacio">C</span><span class="espacio">R</span><span class="espacio">E</span><span class="espacio">A</span><span class="letraT espacio">T</span><span class="letrai espacio">i</span><span class="espacio">V</span><span class="letrai espacio">i</span><span class="letraT espacio">T</span><span class="espacio">Y</span></span> -</h1>
        <h4 id="usuario" style="color: orange;"><?= $_SESSION["usuario"] ?></h4>
    </header>
    <nav>
        <a href="/finalizarsesion" class="movimientoT">Cerrar Sesión</a>
        <a class="bordeNaranja movimientoi" href="/articulo">Introducir Artículo</a>         
    </nav>
<?php include 'components/visualizarArticulos.php'; ?>  

<?php include 'templates/footer.php'; ?>
