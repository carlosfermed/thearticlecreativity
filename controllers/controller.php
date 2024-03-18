
<?php

    session_start();

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }
    
    function mostrarIndexPrincipal() {
        include 'views/index.php';
    }

    function formularioLogin() {
        include 'views/login.php';
    }

    function verificarLogin() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
                include 'models/publicaciones.php';
                
                $usuario = $_POST["usuario"];
                $contrasenia = $_POST["contrasenia"];

                $validar = new conexionPublicaciones();
                $resultado = $validar->getUsuario($usuario);
                $usuarioBD = $resultado->fetch_object();

                if ($usuarioBD != null) {
                    if (password_verify($contrasenia, $usuarioBD->contrasenia) && $usuario === $usuarioBD->nombre) {
                        $_SESSION["usuario"] = $usuario;   
                        header("Location: sesion");
                        exit; // exit();
                    }
                } else 
                    echo "<h3><span style='color: red'>Credenciales incorrectas</span></h3>";                
            }
        }
    }

    function formularioRegistro() {
        include 'views/registro.php';
    }

    function mostrarSesion() {
        include 'views/sesion.php';
    }

    function finalizarSesion() {
        session_unset();    // Elimina todas las variables de sesión.
        session_destroy();  // Destruye completamente la sesión.
        echo "<main style='text-align: center;'>";
        echo "<h3>Has cerrado tu sesión.</h3>";
        echo "<a href='http://localhost:3000/' style='color: green'>Inicio</a>";
        echo "</main>";
    }

    function introducirArticulo() {
        include 'views/introducirArticulo.php';
    }

    // function procesarFormularioArticuloEditado($id) {       // Introducir información del artículo editado

    // }

    function procesarFormularioArticulo($id=false) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["titulo"]) && isset($_POST["contenido"]) && isset($_POST["tipoArticulo"]) &&  isset($_POST["nombreUsuario"])) {
                include "models/publicaciones.php";
                
                $publicacion = new conexionPublicaciones();

                if ($id) {
                    $publicacion->introducirArticuloEditado($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"], $id);
                    echo "<main style='text-align: center;'>";
                    echo "<h3>Artículo editado con éxito.</h3>";
                    echo "<a href='sesion' style='color: green'>Continuar</a>";
                    echo "</main>";
                }
                else {
                    $publicacion->introducirArticulo($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"]);                
                    echo "<main style='text-align: center;'>";
                    echo "<h3>Artículo creado con éxito.</h3>";
                    echo "<a href='sesion' style='color: green'>Continuar</a>";
                    echo "</main>";
                }
                
            }

            //implementar else que controle los tipos de datos recogidos

        }
    }

    function mostrarArticuloIndividual($id, $edit = false) {
        include "models/publicaciones.php";

        $publicacion = new conexionPublicaciones();
        $resultado = $publicacion->getArticulo($id);
        $articuloIndividual = $resultado->fetch_object();

        if ($edit) include 'views/editarArticuloIndividual.php';
        else include 'views/visualizarArticuloIndividual.php';
    }

    // function editarArticulo($id) {                  // Recuperar información sobre el artículo a editar
    //     include "models/publicaciones.php";

    //     $publicacion = new conexionPublicaciones();
    //     $resultado = $publicacion->editarArticulo($id);
    //     $articuloIndividual = $resultado->fetch_object();

    //     include 'views/editarArticuloIndividual.php';
    // }

    function eliminarArticulo($id) {
        include "models/publicaciones.php";

        $publicacion = new conexionPublicaciones();
        $resultado = $publicacion->eliminarArticulo($id);

        if ($resultado) {
            echo "<main style='text-align: center;'>";                
            echo "<h3>Artículo Eliminado.</h3>";
            echo "<a href='/sesion' style='color: green;margin: auto;'>Continuar</a>";
            echo "</main>";
        }
        else {
            echo "<h3><span style='color: red'>No se pudo eliminar el artículo.</span></h3>";
        }
    }

    function procesarFormularioUsuario() {        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["usuario"]) && 
                isset($_POST["contrasenia"]) &&
                isset($_POST["email"])       ) {
                
                $usuario = $_POST["usuario"];
                $contrasenia = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
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

    function filtrarArticulos($tipo) {

        $url = $_POST["url"];

        if ($url == 'sesion') {
            include 'views/sesion.php';
        }
        else
            include 'views/index.php';
    }

?>