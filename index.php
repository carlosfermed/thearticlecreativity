<?php
    /**
     * index.php como controlador frontal.
     * 
     */
    define('CON_CONTROLADOR', true);
    
    include 'controllers/controller.php';    

    // Encamina la petición internamente.
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    // echo $_SERVER["REQUEST_URI"];
    
    if ($uri == '/') {
        mostrarIndexPrincipal();
    } 
    elseif ($uri == '/login') {
        formularioLogin();
    } 
    elseif ($uri == '/registro') {
        formularioRegistro();
    } 
    elseif ($uri == '/sesion') {
        mostrarSesion();
    } 
    else {
        header("HTTP/1.0 404 Not Found");
        echo '<html><body><h1>Página no encontrada</h1></body></html>';
    }
?>