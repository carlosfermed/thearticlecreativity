<?php   
    session_start();

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }
?>
<?php include 'templates/header.php' ?>
    <main>
        <form action="formulariousuario" method="post" enctype="multipart/form-data">  <!-- podemos añadir subida de imagen si fuera necesario -->
        Usuario <input type="text" name="usuario" required/>
        <br>
        Contraseña <input type="password" name="contrasenia" required/>
        <br>            
        Email <input type="email" name="email" required/>
        <br>
        <input type="submit" value="Registrarme" id="boton"/>
        </form>
    </main>        
<?php include 'templates/footer.php' ?>