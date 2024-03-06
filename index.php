<?php
    /**
     * index.php como controlador frontal.
     * 
     */
    define('CON_CONTROLADOR', true);
    
    include 'controllers/controller.php';  

    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    // echo $_SERVER["REQUEST_URI"];
    
    if ($uri == '/') {
        if (isset($_POST["tipoArticulo"])) {
            if ($_POST["tipoArticulo"] != "todos"){
                filtrarArticulos($_POST["tipoArticulo"]);
            }
            else {
                mostrarIndexPrincipal();
            }
        }
        else
            mostrarIndexPrincipal();
    } 
    elseif ($uri == '/login') {
        formularioLogin();
    } 
    elseif ($uri == '/verificarlogin') {
        verificarLogin();
    } 
    elseif ($uri == '/registro') {
        formularioRegistro();
    } 
    elseif ($uri == '/sesion') {
        mostrarSesion();
    } 
    elseif ($uri == '/finalizarsesion') {
        finalizarSesion();
    } 
    elseif ($uri == '/articulo') {
        introducirArticulo();
    } 
    elseif ($uri == '/formulario') {  
        procesarFormularioArticulo();
    } 
    elseif ($uri == '/mostrarArticuloIndividual') {
        if (isset($_GET["id"])) {
            mostrarArticuloIndividual($_GET["id"]);
        }
    }
    elseif ($uri == '/eliminar') {
        if (isset($_POST["idEliminar"])) {
            eliminarArticulo($_POST["idEliminar"]);
        }
    } 
    elseif ($uri == '/formulariousuario') { 
        procesarFormularioUsuario();
    } 
    // elseif ($uri == '/sugerencias') { 
    //     mostrarSugerencias();
    // }
    else {
        header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
    }
?>