
<?php

    session_start();

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }
    
    /**
     * Muestra la página principal del sitio web.
     */
    function mostrarIndexPrincipal() {
        include 'views/index.php';
    }

    /**
     * Muestra la página de login del sitio web.
     */
    function formularioLogin() {
        include 'views/login.php';
    }

    /**
     * Verifica el usuario que se está iniciando sesión.
     */
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

    /**
     * Muestra el formulario de registro de nuevos usuarios.
     */
    function formularioRegistro() {
        include 'views/registro.php';
    }

    /**
     * Muestra el formulario de registro de nuevos usuarios.
     */
    function mostrarSesion() {
        include 'views/sesion.php';
    }

    /**
     * Finaliza la sesión de usuario.
     */
    function finalizarSesion() {
        session_unset();    // Elimina todas las variables de sesión.
        session_destroy();  // Destruye completamente la sesión.
        echo "<main style='text-align: center;'>";
        echo "<h3>Has cerrado tu sesión.</h3>";
        echo "<a href='http://localhost:3000/' style='color: green'>Inicio</a>";
        echo "</main>";
    }

    /**
     * Muestra el formulario de creación de artículos.
     */
    function introducirArticulo() {
        include 'views/introducirArticulo.php';
    }

    /**
     * Envía los datos del artículo creado o editado al modelo.
     */
    function procesarFormularioArticulo($id=false) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["titulo"]) && isset($_POST["contenido"]) && isset($_POST["tipoArticulo"]) &&  isset($_POST["nombreUsuario"])) {
                include "models/publicaciones.php";
                
                $publicacion = new conexionPublicaciones();

                // Procesar cuando el formulario es editado.
                if ($id) {
                    $publicacion->introducirArticuloEditado($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"], $id);
                    echo "<main style='text-align: center;'>";
                    echo "<h3>Artículo editado con éxito.</h3>";
                    echo "<a href='sesion' style='color: green'>Continuar</a>";
                    echo "</main>";
                }
                // Procesar de forma normal.
                else {
                    $publicacion->introducirArticulo($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"]);                
                    echo "<main style='text-align: center;'>";
                    echo "<h3>Artículo creado con éxito.</h3>";
                    echo "<a href='sesion' style='color: green'>Continuar</a>";
                    echo "</main>";
                }
            }
        }
    }

    /**
     * Muestra el artículo de forma individual según ofrezca opción para editarse o no.
     */
    function mostrarArticuloIndividual($id, $edit = false) {
        include "models/publicaciones.php";

        $publicacion = new conexionPublicaciones();
        $resultado = $publicacion->getArticulo($id);
        $articuloIndividual = $resultado->fetch_object();

        if ($edit) include 'views/editarArticuloIndividual.php';
        else include 'views/visualizarArticuloIndividual.php';
    }

    /**
     * Envía los datos del artículo a eliminar al modelo.
     */
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

    /**
     * Envía los datos del nuevo usuario al modelo.
     */
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

    /**
     * Muestra los artículos filtrados por tipo.
     */
    function filtrarArticulos($tipo) {
        $url = $_POST["url"];

        if ($url == 'sesion') {
            include 'views/sesion.php';
        }
        else include 'views/index.php';
    }

?>