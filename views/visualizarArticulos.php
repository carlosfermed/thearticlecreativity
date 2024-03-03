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
        $resultado = $publicaciones->listarArticulos();            
        while ($row = $resultado->fetch_object()) {
            $articulos[] = $row;
        }
        foreach($articulos as $articulo) {
            echo "<div class='item'> título: " . $articulo->titulo . " <br> contenido: " . $articulo->contenido . " <br> fecha:  " . $articulo->fecha . "</div><br><br>";
        }
        // print_r($autores);

    ?>
</main>


<!-- <div style="display: flex; align-items: center; border: 2px solid black; width: 300px; height: 300px">
    <img src="public/img/azura.jpg" alt="Foto Azura" style="height: 300px"/>
</div> -->