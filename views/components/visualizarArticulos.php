<?php
    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

    include "models/publicaciones.php";   


    // $url = "http://localhost:3000/";

    // if (isset($_SESSION["usuario"])) 
    //     $url = "sesion";
    
    // function sesionSioNo() {
        // if ($_SESSION["usuario"])
        //     echo "http://localhost:3000/sesion";
        // else 
        //     echo "http://localhost:3000/";
    // }
    // echo $url;
?>
<!-- Este archivo debe ser una especie de Template para introducir en los archivos donde queramos
que se muestren los artículos -->
<main>
    <?php 
        // $bool = isset($tipo);

        if ((isset($tipo)) && ($tipo !== "todas")) {
            $articulos = array();
            $publicaciones = new conexionPublicaciones();
            $resultado = $publicaciones->listarArticulosFiltrados($tipo);            
            while ($row = $resultado->fetch_object()) {
                $articulos[] = $row;
            }
            if ($articulos != null) {
                foreach($articulos as $articulo) {
                    echo "<div class='item'> Título: <a class='enlace' href='/mostrarArticuloIndividual?id=" . $articulo->id . "'>" 
                        . $articulo->titulo . " </a><br>Temática: " . $articulo->tipo . "<br>Fecha:  " . $articulo->fecha 
                        . "<br>Creador: " . $articulo->usuarioCreador . "</div><br><br>";
                }
            }
            else
                echo "<h4 style='margin-left: 10px;'>No hay resultados</h4>";
        }
        else {
            $publicaciones = new conexionPublicaciones();
            $resultado = $publicaciones->listarArticulos();            
            while ($row = $resultado->fetch_object()) {
                $articulos[] = $row;
            }
            foreach($articulos as $articulo) {
                echo "<div class='item'> Título: <a class='enlace' href='/mostrarArticuloIndividual?id=" . $articulo->id . "'>" 
                    . $articulo->titulo . " </a><br>Temática: " . $articulo->tipo . "<br>Fecha:  " . $articulo->fecha 
                    . "<br>Creador: " . $articulo->usuarioCreador . "</div><br><br>";
            }
        }
    ?>
</main>

<form action='filtrar' method='post' style="position: fixed; top: 88%; left: 50%; transform: translate(-50%,-50%)" >
    Temática 
    <select name="tipoArticulo">
        <option value="todas">Todas</option>

        <option value="alimentacion">Alimentación</option>
        <option value="deporte">Deporte</option>
        <option value="ciencia">Ciencia</option>
        <option value="tecnologia">Tecnología</option>
        <option value="cine">Cine</option>
        <option value="sucesos">Sucesos</option>
    </select>
    <input type="text" value="<?= $miVariable ?>" name="url" hidden>
    <input type="submit" value="Filtrar" class="boton"/>
</form>


<!-- <div style="display: flex; align-items: center; border: 2px solid black; width: 300px; height: 300px">
    <img src="public/img/azura.jpg" alt="Foto Azura" style="height: 300px"/>

    echo "<a href='/mostrarArticuloIndividual?id=" . $articulo->id . "'><div class='item'> título: " . $articulo->titulo . " <br> contenido: " . $articulo->contenido . " <br> fecha:  " . $articulo->fecha . "</div></a><br><br>";
</div> -->