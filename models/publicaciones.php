
<?php
    /**
     * Clase para interactuar con la base de datos de artículos y usuarios.
     */
    class ConexionPublicaciones {

        private $servidor = "localhost";
        private $usuario = "root";
        private $contrasenia = "";
        private $bd = "publicaciones";

        /** 
         * Crea la conexión con la base de datos según los parámetros introducidos.
         * 
         * @param string $servidor      Dirección correspondiente al servidor.
         * @param string $usuario       Nombre de usuario para acceso a la BBDD.
         * @param string $contrasena    Contraseña correspondiente al usuario.   
         * @param string $bd            Nombre de la base de datos. 
         * @return mysqli|null          Conexión a la base de datos.
         */
        private function realizarConexion() {
            try {
                $conexion = new mysqli($this->servidor, $this->usuario, $this->contrasenia, $this->bd);
            } 
            catch (mysqli_sql_exception $e) {
                return null;
            }
            return $conexion;
        }

        /**
         * Introduce un nuevo artículo en la base de datos.
         * 
         * @param string $titulo        El título del artículo.
         * @param string $contenido     El contenido del artículo.
         * @param string $tipo          El tipo/género del artículo.
         * @param string $usuario       Nombre del usuario creador.
         * 
         * @return mysqli_result        Retorna true si la consulta se ejecutó correctamente.
         *
         * @throws Exception            Si hay un fallo al ejecutar la consulta.
         */
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
                    throw new Exception("Fallo al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Actualiza un artículo existente en la base de datos con los nuevos datos proporcionados.
         *
         * @param string $titulo        El nuevo título del artículo.
         * @param string $contenido     El nuevo contenido del artículo.
         * @param string $tipo          El nuevo tipo/género del artículo.
         * @param string $usuario       Nombre del usuario creador.
         * @param int $id               El ID del artículo que se actualizará.
         *
         * @return mysqli_result        Retorna true si la consulta se ejecutó correctamente.
         *
         * @throws Exception            Si hay un fallo al ejecutar la consulta.
         */
        public function introducirArticuloEditado($titulo, $contenido, $tipo, $usuario, $id) {
            $con = $this->realizarConexion();
            $fecha = date('Y-m-d');
            $query = "UPDATE articulos SET titulo='$titulo', contenido='$contenido', tipo='$tipo', fecha='$fecha', usuarioCreador='$usuario' WHERE id=$id;";

            try {
                $resultado = $con->query($query);
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Fallo al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Obtiene todos los artículos almacenados en la base de datos.
         *
         * @return mysqli_result    Retorna un objeto mysqli_result con los resultados de la consulta si se ejecuta correctamente.
         *
         * @throws Exception        Si hay un fallo al ejecutar la consulta.
         */
        public function listarArticulos() {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Se produjo un error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Obtiene los artículos filtrados por tipo almacenados en la base de datos.
         *
         * @param string $tipo      El tipo de artículo por el que se desea filtrar.
         *
         * @return mysqli_result    Retorna un objeto mysqli_result con los resultados de la consulta si se ejecuta correctamente.
         *
         * @throws Exception        Si hay un fallo al ejecutar la consulta.
         */
        public function listarArticulosFiltrados($tipo) {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos WHERE tipo = '$tipo'");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Se produjo un error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Obtiene un artículo específico de la base de datos según su ID.
         *
         * @param int $id               El ID del artículo que se desea obtener.
         *
         * @return mysqli_result|bool   Retorna un objeto mysqli_result con los resultados de la consulta si se ejecuta correctamente, o false si hay un error.
         *
         * @throws Exception            Si hay un fallo al ejecutar la consulta.
         */
        public function getArticulo($id) {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos WHERE id = $id");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Se produjo un error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Obtiene los datos de un artículo específico de la base de datos para su edición.
         *
         * @param int $id               El ID del artículo que se desea editar.
         *
         * @return mysqli_result|bool   Retorna un objeto mysqli_result con los datos del artículo si se ejecuta correctamente, o false si hay un error.
         *
         * @throws Exception            Si hay un fallo al ejecutar la consulta.
         */
        public function editarArticulo($id) {       
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("SELECT * FROM articulos WHERE id = $id");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Se produjo un error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Elimina un artículo específico de la base de datos según su ID.
         *
         * @param int $id               El ID del artículo que se desea eliminar.
         *
         * @return mysqli_result|bool   Retorna un objeto mysqli_result con los resultados de la consulta si se ejecuta correctamente, o false si hay un error.
         *
         * @throws Exception            Si hay un fallo al ejecutar la consulta.
         */
        public function eliminarArticulo($id) {
            $con = $this->realizarConexion();

            try {
                $resultado = $con->query("DELETE FROM articulos WHERE id = $id");
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Se produjo un error al ejecutar la consulta: " . $con->error);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        /**
         * Introduce un nuevo usuario en la base de datos.
         *
         * @param string $usuarioFormulario El nombre de usuario del nuevo usuario.
         * @param string $contrasenia       La contraseña del nuevo usuario.
         * @param string $email             El correo electrónico del nuevo usuario.
         *
         * @return mysqli_result|bool       Retorna true si la consulta se ejecutó correctamente, de lo contrario, retorna false.
         *
         * @throws Exception                Si hay un fallo al ejecutar la consulta.
         */
        public function introducirUsuario($usuarioFormulario, $contrasenia, $email) {
            $con = $this->realizarConexion();
            $query = "INSERT INTO `usuarios` (`nombre`, `contrasenia`, `email`) VALUES ('$usuarioFormulario', '$contrasenia', '$email');";

            try {
                $resultado = $con->query($query);
                if ($resultado) {
                    return $resultado;
                } 
                else {
                    throw new Exception("Fallo al ejecutar la consulta: " . $con->error);
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