<?php
    // session_start();     // COMENTADO TRAS LA ÚLTIMA VERSIÓN

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
        <h1>- The ARTiCLE CREATiViTY -</h1>
        <h4 id="usuario" style="color: orange;"><?= $_SESSION["usuario"] ?></h4>
    </header>
    <nav>
        <a href="/finalizarsesion">Cerrar Sesión</a>
        <a class="bordeNaranja" href="/articulo">Introducir Artículo</a>         
    </nav>
<?php include 'components/visualizarArticulos.php'; ?>  

<?php include 'templates/footer.php'; ?>
