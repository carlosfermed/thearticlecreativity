
<!-- Vista principal (Landing Page) -->

<?php 
    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

    include 'templates/header.php'; 
?>

<?php //  Añadir template con los artículos varios ?>

<?php include 'templates/footer.php'; ?>