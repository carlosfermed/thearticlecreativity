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
        // Filtra los artículos por un tipo determinado.
        if ((isset($tipo)) && ($tipo !== "todas")) {
            $articulos = array();
            $publicaciones = new conexionPublicaciones();
            $resultado = $publicaciones->listarArticulosFiltrados($tipo);            
            while ($row = $resultado->fetch_object()) {
                $articulos[] = $row;
            }
            if ($articulos != null) {
                foreach($articulos as $articulo) {
                    echo "<div class='". $articulo->tipo ."'><a class='enlace' href='/mostrarArticuloIndividual?id=" . $articulo->id . "'>Título: <span style='font-weight: bold; color: blue;'>" 
                    . $articulo->titulo . "</span><br>Temática: " . $articulo->tipo . "<br>Fecha:  " . $articulo->fecha 
                    . "<br>Creador: " . $articulo->usuarioCreador . "</div></a>";
                }
            }
            else
                echo "<h4 style='margin-left: 10px;'>No hay resultados</h4>";
        }
        // Muestra todos los artículos.
        else {
            $publicaciones = new conexionPublicaciones();
            $resultado = $publicaciones->listarArticulos();            
            while ($row = $resultado->fetch_object()) {
                $articulos[] = $row;
            }
            foreach($articulos as $articulo) {
                echo "<div class='". $articulo->tipo ."'><a class='enlace' href='/mostrarArticuloIndividual?id=" . $articulo->id . "'>Título: <span style='font-weight: bold; color: blue;'>" 
                    . $articulo->titulo . "</span><br>Temática: " . $articulo->tipo . "<br>Fecha:  " . $articulo->fecha 
                    . "<br>Creador: " . $articulo->usuarioCreador . "</div></a>";
                // echo "<div class='". $articulo->tipo ."'> Título: <a class='enlace' href='/mostrarArticuloIndividual?id=" . $articulo->id . "'>" 
                //     . $articulo->titulo . " </a><br>Temática: " . $articulo->tipo . "<br>Fecha:  " . $articulo->fecha 
                //     . "<br>Creador: " . $articulo->usuarioCreador . "</div><br><br>";
            }
        }
    ?>
</main>

<input type="button" value="Reportar incidencia" id="mensajeIncidencia" 
    onclick="alert(`En caso de incidencia, contacte con el administrador enviando un email a: 
                    incidencias@creativity.com`)" 
/>

<form action='filtrar' method='post' id="formularioBusqueda" >
    <span style="text-align: center;"><b>Buscador</b></span>
    <select name="tipoArticulo">
        <option value="todas">Todas</option>
        <option value="alimentacion">Alimentación</option>
        <option value="deporte">Deporte</option>
        <option value="ciencia">Ciencia</option>
        <option value="tecnologia">Tecnología</option>
        <option value="cine">Cine</option>
        <option value="sucesos">Sucesos</option>
    </select>
    <input type="text" value="<?= $redireccionamiento ?>" name="url" hidden>
    <input type="submit" value="Filtrar" class="boton"/>
</form>