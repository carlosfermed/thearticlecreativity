<?php
    class Conexion {

        public function realizarConexion($servidor, $usuario, $contrasenia, $bd) {
            try {
                $conexion = new mysqli($servidor, $usuario, $contrasenia, $base_de_datos);
            } 
            catch (mysqli_sql_exception $e) {
                return null;
            }
            return $conexion;
        }

    }

?>