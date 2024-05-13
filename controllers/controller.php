
<?php

    session_start();

    if (!defined('CON_CONTROLADOR')) {
        echo "Acceso denegado. No se puede solicitar este archivo directamente.";
        die();
    }
    
    /**
     * Muestra la página principal del sitio web.
     * 
     * Este método incluye el archivo 'views/index.php', que contiene la estructura y el contenido
     * de la página principal del sitio web.
     * 
     * @return void No retorna ningún valor. En lugar de ello, muestra la página principal del sitio web.
     */
    function mostrarIndexPrincipal() {
        include 'views/index.php';
    }

    /**
     * Muestra el formulario de inicio de sesión.
     * 
     * Este método incluye el archivo 'views/login.php', que contiene la estructura y los campos
     * necesarios para que los usuarios inicien sesión en el sistema.
     * 
     * @return void No retorna ningún valor. En su lugar, muestra el formulario de inicio de sesión.
     */
    function formularioLogin() {
        include 'views/login.php';
    }

    /**
     * Verifica las credenciales de inicio de sesión del usuario.
     * 
     * Este método se encarga de iniciar sesión para un usuario verificando las credenciales
     * proporcionadas a través de un formulario de inicio de sesión. Si las credenciales son
     * válidas, el usuario se autentica y se crea una sesión para él.
     * 
     * Si las credenciales son incorrectas, se muestra un mensaje de error.
     * 
     * @return void No retorna ningún valor. En su lugar, inicia sesión para el usuario o muestra un mensaje de error.
     */
    function verificarLogin() {
        // session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {

                include 'models/publicaciones.php';
                // Se recogen los datos de ambos campos del formulario.
                $usuario = $_POST["usuario"];
                $contrasenia = $_POST["contrasenia"];
                // Se abre conexión con Base de datos y se recogen los datos del nombre de usuario.
                $validar = new conexionPublicaciones();
                $resultado = $validar->getUsuario($usuario);
                $usuarioBD = $resultado->fetch_object();
                // Se realiza la verificación que valida el proceso.
                if ($usuarioBD != null) {
                    if (password_verify($contrasenia, $usuarioBD->contrasenia) && $usuario === $usuarioBD->nombre) {
                        $_SESSION["usuario"] = $usuario;   
                        header("Location: sesion");
                        exit; // exit();
                    }
                    else {
                        echo "<h3><span style='color: red'>Credenciales incorrectas</span></h3>";       
                    }
                } else 
                    echo "<h3><span style='color: red'>Credenciales incorrectas</span></h3>";                
            }
        }
    }

    /**
     * Muestra el formulario de registro de nuevos usuarios.
     * 
     * Este método incluye el archivo 'views/registro.php', que contiene la estructura y los campos
     * necesarios para que los usuarios se registren en el sistema.
     * 
     * @return void No retorna ningún valor. En su lugar, muestra el formulario de registro de nuevos usuarios.
     */
    function formularioRegistro() {
        include 'views/registro.php';
    }

    /**
     * Muestra la página de sesión de usuarios.
     * 
     * Este método incluye el archivo 'views/sesion.php', que contiene la estructura y el contenido
     * de la página de sesión de usuarios, donde los usuarios pueden interactuar después de iniciar sesión.
     * 
     * @return void No retorna ningún valor. En su lugar, muestra la página de sesión de usuarios.
     */
    function mostrarSesion() {
        include 'views/sesion.php';
    }

    /**
     * Finaliza la sesión de usuario.
     * 
     * Este método elimina todas las variables de sesión y destruye completamente la sesión del usuario.
     * Luego, muestra un mensaje indicando que la sesión ha sido cerrada.
     * 
     * @return void No retorna ningún valor. En su lugar, muestra un mensaje de confirmación de cierre de sesión.
     */
    function finalizarSesion() {
        session_unset();    // Elimina todas las variables de sesión.
        session_destroy();  // Destruye completamente la sesión.
        echo "<main style='text-align: center;'>";
        echo "<h3>Has cerrado tu sesión.</h3>";
        echo "<a href='http://localhost:3000/' style='color: green'>Inicio</a>";
        echo "</main>";
    }

    /**
     * Muestra el formulario para introducir un nuevo artículo.
     * 
     * Este método incluye el archivo 'views/introducirArticulo.php', que contiene el formulario
     * para introducir un nuevo artículo en el sistema.
     * 
     * @return void No retorna ningún valor. En lugar de ello, muestra el formulario para introducir un nuevo artículo.
     */
    function introducirArticulo() {
        include 'views/introducirArticulo.php';
    }

    /**
     * Procesa el formulario de creación o edición de un artículo.
     * 
     * Este método procesa los datos enviados a través del formulario de creación
     * o edición de un artículo. Dependiendo de si se proporciona un ID de artículo,
     * insertará un nuevo artículo en la base de datos o actualizará uno existente.
     * 
     * @param bool|int $id  (Opcional) El ID del artículo si se está editando, false si se está creando uno nuevo.
     * 
     * @return void         No retorna ningún valor. En lugar de ello, imprime un mensaje de éxito en caso de
     *                      creación o edición exitosa del artículo.
     */
    function procesarFormularioArticulo($id=false) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["titulo"]) && isset($_POST["contenido"]) && isset($_POST["tipoArticulo"]) &&  isset($_POST["nombreUsuario"])) {
                include "models/publicaciones.php";
                
                $publicacion = new conexionPublicaciones();

                // Procesar cuando el formulario es editado.
                if ($id) {
                    $publicacion->introducirArticuloEditado($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"], $id);
                    echo "<main style='text-align: center;'>";
                    echo "<h3>Artículo editado con éxito.</h3>";
                    echo "<a href='sesion' style='color: green'>Continuar</a>";
                    echo "</main>";
                }
                // Procesar de forma normal.
                else {
                    $publicacion->introducirArticulo($_POST["titulo"], $_POST["contenido"], $_POST["tipoArticulo"], $_POST["nombreUsuario"]);                
                    echo "<main style='text-align: center;'>";
                    echo "<h3>Artículo creado con éxito.</h3>";
                    echo "<a href='sesion' style='color: green'>Continuar</a>";
                    echo "</main>";
                }
            }
        }
    }

    /**
     * Muestra un artículo de forma individual.
     * 
     * Este método recupera un artículo específico de la base de datos y lo muestra de forma individual en la vista.
     * Dependiendo del valor del parámetro $edit, se puede ofrecer la opción de editar el artículo.
     * 
     * @param int $id     El ID del artículo que se desea mostrar.
     * @param bool $edit  (Opcional) Indica si se ofrece la opción de editar el artículo. Por defecto, es false.
     * 
     * @return void No retorna ningún valor. En su lugar, muestra el artículo individual en la vista.
     */
    function mostrarArticuloIndividual($id, $edit = false) {
        include "models/publicaciones.php";

        $publicacion = new conexionPublicaciones();
        $resultado = $publicacion->getArticulo($id);
        $articuloIndividual = $resultado->fetch_object();

        if ($edit) include 'views/editarArticuloIndividual.php';
        else include 'views/visualizarArticuloIndividual.php';
    }

    /**
     * Elimina el artículo.
     * 
     * Este método envía los datos del artículo a eliminar al modelo correspondiente.
     * Después de eliminar el artículo, muestra un mensaje indicando si la operación fue exitosa o no.
     * 
     * @param int $id El ID del artículo que se desea eliminar.
     * 
     * @return void No retorna ningún valor. En su lugar, muestra un mensaje indicando si el artículo fue eliminado correctamente.
     */
    function eliminarArticulo($id) {
        include "models/publicaciones.php";

        $publicacion = new conexionPublicaciones();
        $resultado = $publicacion->eliminarArticulo($id);

        if ($resultado) {
            echo "<main style='text-align: center;'>";                
            echo "<h3>Artículo Eliminado.</h3>";
            echo "<a href='/sesion' style='color: green;margin: auto;'>Continuar</a>";
            echo "</main>";
        }
        else {
            echo "<h3><span style='color: red'>No se pudo eliminar el artículo.</span></h3>";
        }
    }

    /**
     * Procesa el formulario de registro de un nuevo usuario.
     *
     * Este método verifica los datos enviados a través del formulario de registro
     * de un nuevo usuario. Se asegura de que se proporcionen el nombre de usuario,
     * la contraseña y el correo electrónico. Luego, verifica si el formato del correo
     * electrónico es válido y si el nombre de usuario ya está en uso. Finalmente,
     * envía los datos al modelo para crear el nuevo usuario en la base de datos.
     * 
     * @link(https://www.php.net/manual/es/function.password-hash)
     * @link(https://www.php.net/manual/es/function.in-array)
     * @link(https://www.php.net/manual/es/function.filter-var)
     *
     * @return void No retorna ningún valor. En lugar de ello, muestra un mensaje de
     *              éxito o una alerta en caso de error en el formato del correo electrónico
     *              o si el nombre de usuario ya está en uso.
     */
    function procesarFormularioUsuario() {        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["usuario"]) && 
                isset($_POST["contrasenia"]) &&
                isset($_POST["email"])       ) {
                
                $usuario = $_POST["usuario"];
                $contrasenia = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
                $email = $_POST["email"];
                
                // Se abre conexión mediante la clase ConexionPublicaciones.
                include 'models/publicaciones.php';
                $publicacion = new ConexionPublicaciones();
                $usuarios = $publicacion->getUsuarios();

                // Se realiza la validación del email.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<script>alert('El formato del correo electrónico es incorrecto. Por favor, introduce una dirección de correo válida.'); window.history.back()</script>";
                }
                // Se realiza la comprobación de nombre de usuario para garantizar que no existan duplicados.
                else if (in_array($usuario, $usuarios)) {
                    echo "<script>alert('El nombre no está disponible. Por favor, introduce otro nombre válido.'); window.history.back()</script>";
                } 
                else {                
                    // include 'models/publicaciones.php';
                    // $publicacion = new ConexionPublicaciones();

                    $publicacion->introducirUsuario($usuario, $contrasenia, $email);

                    echo "<main style='text-align: center;'>";                
                    echo "<h3>Usuario creado con éxito, ya puedes acceder mediante Login a tu cuenta.</h3>";
                    echo "<a href='/' style='color: green;margin: auto;'>Continuar</a>";
                    echo "</main>";
                }
            }
        }        
    }

    /**
     * Filtra y muestra los artículos según su tipo.
     *
     * Este método filtra los artículos de la base de datos según el tipo especificado
     * y luego muestra los resultados en la vista correspondiente. Dependiendo de la
     * URL proporcionada en el formulario, se redirige a la página de sesión o se muestra
     * la página principal. Este método se utiliza para mostrar los artículos filtrados
     * por tipo en la interfaz de usuario.
     *
     * @param string $tipo El tipo de artículo por el que se desea filtrar.
     * 
     * @return void No retorna ningún valor. En lugar de ello, incluye la vista correspondiente
     *              según la URL proporcionada en el formulario.
     */
    function filtrarArticulos($tipo) {
        $url = $_POST["url"];

        if ($url == 'sesion') {
            include 'views/sesion.php';
        }
        else include 'views/index.php';
    }

?>