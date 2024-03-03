
<?php
    
    function mostrarIndexPrincipal() {
        include 'views/index.php';
    }

    function formularioLogin() {
        include 'views/login.php';
    }

    function formularioRegistro() {
        include 'views/registro.php';
    }

    function mostrarSesion() {
        include 'views/sesion.php';
    }

    function introducirArticulo() {
        include 'views/introducirArticulo.php';
    }

    function finalizarSesion() {
        unset($_SESSION["usuario"]);
        unset($_SESSION["contrasenia"]);
        header("Location: login");
    }

    function procesarFormularioUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "models/publicaciones.php";

            $publicacion = new conexionPublicaciones();

            $publicacion->listarArticulos();
            $resultado = $con -> query($query);            
            while ($row = $resultado -> fetch_object()) {
                $autores[] = $row;
            }

        }
        
    }

    function procesarFormularioArticulo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["titulo"]) && isset($_POST["contenido"]) && isset($_POST["tipoArticulo"]) &&  isset($_POST["nombreUsuario"])) {
                include "models/publicaciones.php";

                $publicacion = new conexionPublicaciones();

                $publicacion->introducirArticulo($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"]);
                
                echo "Artículo creado con éxito<br>";
                echo "<a href='sesion' style='color: green;'>Continuar</a>";
            }

            //implementar else que controle los tipos de datos recogidos

        }
        // mostrar aviso que indique que no se ha enviado el formulario (opcional)
    }

?>