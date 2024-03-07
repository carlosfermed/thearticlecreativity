<?php   
    
    // session_start();  NO NECESARIO
    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }

?>
<?php include 'templates/header.php' ?>
    <main>
        <form action="verificarlogin" method="post">
        Usuario <input type="text" name="usuario" required/>
        <br>
        Contraseña <input type="password" name="contrasenia" required/>
        <br>
        <input type="submit" value="Entrar" id="boton"/>
        </form>
    </main>        
<?php include 'templates/footer.php' ?>