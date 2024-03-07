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
    <link rel="stylesheet" type="text/css" href="public/css/estiloGenerico.css">
</head>
<body>
    <header>        
        <h1>- The ARTiCLE CREATiViTY -</h1>
        <h4 id="usuario" style="color: orange;"><?= $_SESSION["usuario"] ?></h4>
    </header>
    <nav>
        <a href="sesion" class="bordeNaranja" >Volver</a>
    </nav>
    <form action="formulario" method="post" >
        Título <input type="text" name="titulo" required/>
        <br>        
        <textarea type="text" rows="15" name="contenido" placeholder="Este artículo trata sobre..." required/></textarea>
        <br>
        Temática 
        <select name="tipoArticulo">
            <option value="alimentacion">Alimentación</option>
            <option value="deporte">Deporte</option>
            <option value="ciencia">Ciencia</option>
            <option value="tecnologia">Tecnología</option>
            <option value="cine">Cine</option>
            <option value="sucesos">Sucesos</option>
        </select>
        <input type="text" name="nombreUsuario" value="<?= $_SESSION["usuario"] ?>" hidden >
        <br>
        <input type="submit" value="Publicar artículo" class="boton"/>
    </form>
<?php include 'templates/footer.php'; ?>