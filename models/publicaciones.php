<?php
    class ConexionPublicaciones {

        private $servidor = "localhost";
        private $usuario = "root";
        private $contrasenia = "";
        private $bd = "publicaciones";

        public function realizarConexion() {
            try {
                $conexion = new mysqli($this->servidor, $this->usuario, $this->contrasenia, $this->bd);
            } 
            catch (mysqli_sql_exception $e) {
                return null;
            }
            return $conexion;
        }

        public function introducirArticulo($titulo, $contenido, $tipo, $usuario) {
            $con = $this->realizarConexion();
            $fecha = date('Y-m-d');
            $query = "INSERT INTO `articulos` (`id`, `titulo`, `contenido`, `tipo`, `fecha`, `usuarioCreador`) VALUES (NULL, '$titulo', '$contenido', '$tipo', '$fecha', '$usuario');";

            try {
                $resultado = $con->query($query);
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            

            //INSERT INTO `articulos` (`id`, `titulo`, `contenido`, `tipo`, `fecha`, `usuarioCreador`) VALUES (NULL, 'Megalodón', 'La última película de Robert Ramirez que rompe records de taquilla.', 'tecnologia', '2024-02-29', 'carlos');


        }

        public function listarArticulos() {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

?>