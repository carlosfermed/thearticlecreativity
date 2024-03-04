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
            echo "<h3><span style='color: red'>Credenciales incorrectas</span></h3>";
    }
    
    function validarUsuario($usuario, $contrasenia) {
        include 'models/publicaciones.php';

        $validar = new conexionPublicaciones();

        $resultado = $validar->getUsuario($usuario);

        $usuarioBD = $resultado->fetch_object();

        if ($usuario === $usuarioBD->nombre && $contrasenia === $usuarioBD->contrasenia) {
            $_SESSION["usuario"] = $usuario;
            // $_SESSION["contrasenia"] = $contrasenia;   NO NECESARIA DE ALMACENAR     
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