<?php 

require_once("./models/publicaciones.php");
use PHPUnit\Framework\TestCase;

// Precaución: cualquier comprobación de los test altera de forma real los datos en la BBDD.

final class PublicacionesTest extends TestCase {
    
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $basedatos = 'publicaciones';
    
    /**
     * Test para verificar la conexión exitosa a la base de datos.
     */
    public function testConexionOK(): void {
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Realiza la conexión utilizando los datos de conexión proporcionados.
        $resultado = $publicaciones -> realizarConexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        // Verifica que el resultado de la conexión no sea nulo.
        $this -> assertNotNull($resultado);
    }

    /**
     * Test para verificar la conexión fallida a la base de datos.
     */
    public function testConexionKO(): void {
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Realiza la conexión utilizando los datos de conexión proporcionados (erroneos para provocar el fallo).
        $resultado = $publicaciones -> realizarConexion($this->servidor, 'bdd', 'kevin', $this->contrasena);
        // Verifica que en caso de error devuelve un valor null.
        $this -> assertNull($resultado->connect_error);
    }

    /**
     * Test para verificar la introducción de un artículo.
     */
    public function testIntroducirArticulo(): void {
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método introducirArticulo con datos de ejemplo
        $resultado = $publicaciones->introducirArticulo("Título del artículo", "Contenido del artículo", "cine", "kevin");
        // Verifica que la inserción del artículo fue exitosa.
        $this->assertTrue($resultado);
    }

    /**
     * Test para verificar la edición de un artículo.
     */
    public function testIntroducirArticuloEditado(): void {
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método introducirArticuloEditado con datos de ejemplo y el ID del artículo a editar.
        $resultado = $publicaciones->introducirArticuloEditado("Título del artículo", "Contenido del artículo", "cine", "kevin", 37);
        // Verifica que la inserción del artículo fue exitosa.
        $this->assertTrue($resultado);
    }

    /**
     * Test para verificar la lista de artículos.
     */
    public function testListarArticulo(): void {
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método listarArticulos.
        $resultado = $publicaciones->listarArticulos();
        // Verifica que la lista de artículos devuelta no sea nula.
        $this->assertNotNull($resultado);
    }

    /**
     * Test para obtener un artículo específico.
     */
    public function testGetArticulo(): void {
        // Crea un objeto con los datos esperados del artículo.
        $obj = new stdClass();
        $obj -> titulo="Megalodón";
        $obj -> contenido="La última película de Robert Ramirez que rompe records de taquilla.";
        $obj -> tipo="tecnologia";
        $obj -> id="3";
        $obj -> fecha="2024-02-29";
        $obj -> usuarioCreador="carlos";

        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método getArticulo para obtener el artículo con ID 3.
        $resultado = $publicaciones->getArticulo(3);
        // Obtene el objeto del resultado.
        $row = $resultado->fetch_object();
        // Verifica que el objeto del resultado coincide con el objeto esperado.
        $this->assertEquals($obj, $row);
    }

    /**
     * Test para editar un artículo.
     */
    public function testEditarArticulo(): void {
        // Defini el ID del artículo a editar.
        $idArticulo = 1; 
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método editarArticulo para editar el artículo con el ID especificado declarado previamente.
        $resultado = $publicaciones->editarArticulo($idArticulo);
        // Verifica que el resultado no es nulo.
        $this->assertNotNull($resultado);
        // Verifica que el resultado es una instancia de mysqli_result.
        $this->assertInstanceOf(mysqli_result::class, $resultado);
    }

    /**
     * Test para eliminar un artículo.
     */
    public function testEliminarArticulo(): void {
        // Defini el ID del artículo a editar.
        $idArticulo = 7; 
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método eliminarArticulo para eliminar el artículo con el ID especificado declarado previamente.
        $resultado = $publicaciones->eliminarArticulo($idArticulo);
        // Verifica que el resultado no es nulo.
        $this->assertNotNull($resultado);
        // Verifica que el resultado es verdadero.
        $this->assertTrue($resultado);
    }

    /**
     * Test para introducir un nuevo usuario.
     */
    public function testIntroducirUsuario(): void {
        // Se definen los datos del usuario a insertar.
        $usuarioFormulario = "usuario123";
        $contrasenia = "pass123";
        $email = "usuario123@test.com";
    
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();    
        // Llama a la función introducirUsuario con los datos del usuario
        $resultado = $publicaciones->introducirUsuario($usuarioFormulario, $contrasenia, $email);    
        // Verifica que el resultado no sea nulo
        $this->assertNotNull($resultado);    
        // Verifica que el resultado sea verdadero (indicando que la inserción fue exitosa)
        $this->assertTrue($resultado);
    }

    /**
     * Test para obtener los datos de un usuario.
     */
    public function testGetUsuario() {
        // Defini el nombre de usuario para buscar en la base de datos.
        $nombreUsuario = "usuario123"; 
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama a la función getUsuario con el nombre de usuario
        $resultado = $publicaciones->getUsuario($nombreUsuario);
        // Verifica que el resultado no sea nulo
        $this->assertNotNull($resultado);
        // Verifica que el resultado sea un objeto mysqli_result
        $this->assertInstanceOf(mysqli_result::class, $resultado);
        // Verifica que el resultado contiene al menos una fila de datos (indicando que se encontró el usuario)
        $this->assertGreaterThan(0, $resultado->num_rows);
    }

    /**
     * Test para obtener todos los usuarios.
     */
    public function testGetUsuarios(): void {
        // Crea una instancia de la clase ConexionPublicaciones.
        $publicaciones = new ConexionPublicaciones();
        // Llama al método getUsuarios.
        $resultado = $publicaciones->getUsuarios();
        // Verifica que el resultado objetnido no sea nulo.
        $this->assertNotNull($resultado);
    }


}

?>
