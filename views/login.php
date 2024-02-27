<?php   
    
    session_start();
    
    if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
        
        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];
        
        if (validarUsuario($usuario, $contrasenia)) {
            header("Location: sesion");
            exit; // exit();
        }
        else
            echo "<span>Credenciales incorrectas</span>";
    }
    
    function validarUsuario($usuario, $contrasenia) {
        if ($usuario === "foc" && $contrasenia === "222") {
            $_SESSION["usuario"] = $usuario;
            $_SESSION["contrasenia"] = $contrasenia;        
            return true;
        }             
        else 
            return false;
    } 

?>
<?php include 'templates/header.php' ?>
        <main>
            <form action="login" method="post">
            Usuario <input type="text" name="usuario" required/>
            <br>
            Contraseña <input type="password" name="contrasenia" required/>
            <br>
            <input type="submit" value="Entrar" id="boton"/>
            </form>
        </main>        
<?php include 'templates/footer.php' ?>