<?php
    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be creative</title>
    <link rel="stylesheet" type="text/css" href="public/css/estiloGenerico.css">
</head>
<body>
    <header>        
        <h1>- The ARTiCLE CREATiViTY -</h1>
        <h5 id="usuario"></h5>
    </header>
    <nav>
        <a href="/">Inicio</a>
        <a href="/login">Login</a>
        <a href="/registro">Registro</a>
    </nav>
