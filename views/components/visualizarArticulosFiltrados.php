<?php

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

    include "models/publicaciones.php";

    
?>
<!-- Este archivo debe ser una especie de Template para introducir en los archivos donde queramos
que se muestren los artículos -->
<main>
    <?php 
        $publicaciones = new conexionPublicaciones();
        $resultado = $publicaciones->listarArticulosFiltrados($tipo);            
        while ($row = $resultado->fetch_object()) {
            $articulos[] = $row;
        }
        foreach($articulos as $articulo) {
            echo "<div class='item'> Título: <a class='enlace' href='/mostrarArticuloIndividual?id=" . $articulo->id . "'>" 
                . $articulo->titulo . " </a><br>Temática: " . $articulo->tipo . "<br>Fecha:  " . $articulo->fecha 
                . "<br>Creador: " . $articulo->usuarioCreador . "</div><br><br>";
        }
    ?>
</main>
<form action='http://localhost:3000/' method='post'>
    Temática 
    <select name="tipoArticulo">
        <option value="todos">Todas</option>

        <option value="alimentacion">Alimentación</option>
        <option value="deporte">Deporte</option>
        <option value="ciencia">Ciencia</option>
        <option value="tecnologia">Tecnología</option>
        <option value="cine">Cine</option>
        <option value="sucesos">Sucesos</option>
    </select>
    <input type="submit" value="Filtrar" class="boton"/>
</form>