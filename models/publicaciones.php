<?php
    class ConexionPublicaciones {

        private $servidor = "localhost";
        private $usuario = "root";
        private $contrasenia = "";
        private $bd = "publicaciones";

        private function realizarConexion() {
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
        }

        // Todos los artículos
        public function listarArticulos() {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Algún tipo de error se produjo al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Artículo individual
        public function getArticulo($id) {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos WHERE id = $id");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Algún tipo de error se produjo al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        function getUsuario($usuario) {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM usuarios WHERE nombre = '$usuario'");
                if ($resultado) {                    
                    return $resultado;
                } 
                else {
                    throw new Exception("No se encontró ningún usuario con ese nombre: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }


        }

    }

?>

<!--  Falta cerrar conexion $con->close() -->