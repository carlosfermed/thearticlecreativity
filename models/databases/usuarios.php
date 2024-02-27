<?php
    class Usuario {

        public function validarUsuario($con, $usuario, $contrasenia) {
            if ($usuario === "foc" && $contrasenia === "2222") {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["contrasenia"] = $contrasenia;
            
                return true;
            }             
            else 
                return false;            
        }

    }

?>