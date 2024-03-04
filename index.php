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
    elseif ($uri == '/formulariousuario') { 
        procesarFormularioUsuario();
    } 
    else {
        header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
    }
?>