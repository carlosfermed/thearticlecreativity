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
        Título <input type="text" name="titulo" value="<?= $articuloIndividual->titulo ?>" required/>
        <br>        
        <textarea type="text" rows="15" name="contenido" required><?= $articuloIndividual->contenido ?></textarea>
        <br>
        Temática 
        <select name="tipoArticulo">
            <option value="alimentacion"    <?= $articuloIndividual->tipo === "alimentacion" ? "selected" : "" ?> >Alimentación</option>
            <option value="deporte"         <?= $articuloIndividual->tipo === "deporte" ? "selected" : "" ?>      >Deporte</option>
            <option value="ciencia"         <?= $articuloIndividual->tipo === "ciencia" ? "selected" : "" ?>      >Ciencia</option>
            <option value="tecnologia"      <?= $articuloIndividual->tipo === "tecnologia" ? "selected" : "" ?>   >Tecnología</option>
            <option value="cine"            <?= $articuloIndividual->tipo === "cine" ? "selected" : "" ?>         >Cine</option>
            <option value="sucesos"         <?= $articuloIndividual->tipo === "sucesos" ? "selected" : "" ?>      >Sucesos</option>
        </select>
        <input type="text" name="nombreUsuario" value="<?= $_SESSION["usuario"] ?>" hidden>
        <input type='text' value='<?= $articuloIndividual->id ?>' name='idEditar' hidden>

        <br>
        <input type="submit" value="Guardar cambios" class="boton"/>
    </form>
<?php include 'templates/footer.php'; ?>