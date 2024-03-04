
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
        session_unset(); // Eliminar todas las variables de sesión
        echo "<main style='text-align: center;'>";
        echo "<h3>Has cerrado tu sesión.</h3>";
        echo "<a href='/' style='color: green'>Inicio</a>";
        echo "</main>";
    }

    function procesarFormularioArticulo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["titulo"]) && isset($_POST["contenido"]) && isset($_POST["tipoArticulo"]) &&  isset($_POST["nombreUsuario"])) {
                include "models/publicaciones.php";

                $publicacion = new conexionPublicaciones();

                $publicacion->introducirArticulo($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"]);
                
                echo "<main style='text-align: center;'>";
                echo "<h3>Artículo creado con éxito.</h3>";
                echo "<a href='sesion' style='color: green'>Continuar</a>";
                echo "</main>";
            }

            //implementar else que controle los tipos de datos recogidos

        }
        // mostrar aviso que indique que no se ha enviado el formulario (opcional)
    }

    function mostrarArticuloIndividual($id) {
        include "models/publicaciones.php";

        $publicacion = new conexionPublicaciones();

        $resultado = $publicacion->getArticulo($id);

        $articuloIndividual = $resultado->fetch_object();

        include 'views/visualizarArticuloIndividual.php';
    }

    function procesarFormularioUsuario() {          // pendiente
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["usuario"]) && 
                isset($_POST["contrasenia"]) &&
                isset($_POST["email"])       ) {
                
                $usuario = $_POST["usuario"];
                $contrasenia = $_POST["contrasenia"];
                $email = $_POST["email"];
                
                include 'models/publicaciones.php';

                $publicacion = new ConexionPublicaciones();

                $publicacion->introducirUsuario($usuario, $contrasenia, $email);

                echo "<main style='text-align: center;'>";                
                echo "<h3>Usuario creado con éxito, ya puedes acceder mediante Login a tu cuenta.</h3>";
                echo "<a href='/' style='color: green;margin: auto;'>Continuar</a>";
                echo "</main>";

            }
        }        
    }

?>