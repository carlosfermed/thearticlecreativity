
<!-- Vista principal (Landing Page) -->

<?php 
    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

    include 'templates/header.php'; 
?>

<?php include 'components/visualizarArticulos.php'; ?>

<?php include 'templates/footer.php'; ?>