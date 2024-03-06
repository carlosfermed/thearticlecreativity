
<!-- Vista principal (Landing Page) -->

<?php 
    session_start();
    
    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

    include 'templates/header.php'; 
?>

<?php 
    if (isset($_SESSION["usuario"])) {
        
    }
    include 'components/visualizarArticulos.php'; ?>

<?php include 'templates/footer.php'; ?>