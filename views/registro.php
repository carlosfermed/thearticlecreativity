<?php   

    // if (!defined('CON_CONTROLADOR')) {
    //     echo "Acceso denegado. No se puede solicitar este archivo directamente.";
    //     die();
    // }

    session_start();
    
    if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
        
        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];
        
        if (validarUsuario($usuario, $contrasenia)) {
            header("Location: sesion.php");
            exit; // exit();
        }
        else
            echo "<span>Credenciales incorrectas</span>";
    }
    
    function validarUsuario($usuario, $contrasenia) {
        if ($usuario === "foc" && $contrasenia === "Fdwes!22") {
            $_SESSION["usuario"] = $usuario;
            $_SESSION["contrasenia"] = $contrasenia;
        
            $_SESSION["sesionAutentificada"] = true;
        }             
        else 
            $_SESSION["sesionAutentificada"] = false;
        
        return $_SESSION["sesionAutentificada"];
    } 

?>
<?php include 'templates/header.php' ?>
    <main>
        <form action="login.php" method="post">
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