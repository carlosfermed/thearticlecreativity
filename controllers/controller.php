
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

    function procesarFormulario() {
        if ($_POST) {
            print_r($_POST);
            print_r($_FILES);
            $imageurl = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($imageurl, "public/img/azura.jpg");
        }
    }

?>