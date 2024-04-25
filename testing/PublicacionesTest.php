<?php 

require_once("publicaciones.php");
use PHPUnit\Framework\TestCase;

// Precaución: cualquier comprobación de los test altera de forma real los datos de la BBDD.

final class PublicacionesTest extends TestCase {
    
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $basedatos = 'publicaciones';
    
    public function testConexionOK(): void {
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones -> realizarConexion($this->servidor, $this->basedatos, $this->usuario, $this->contrasena);
        $this -> assertNotNull($resultado);
    }

    public function testConexionKO(): void {
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones -> realizarConexion($this->servidor, 'bdd', 'kevin', $this->contrasena);
        $this -> assertNull($resultado->connect_error);
    }

    public function testIntroducirArticulo(): void {
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->introducirArticulo("Título del artículo", "Contenido del artículo", "cine", "kevin");
        $this->assertTrue($resultado);
    }

    public function testIntroducirArticuloEditado(): void {
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->introducirArticuloEditado("Título del artículo", "Contenido del artículo", "cine", "kevin", 37);
        $this->assertTrue($resultado);
    }

    public function testListarArticulo(): void {
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->listarArticulos();
        $this->assertNotNull($resultado);
    }

    public function testGetArticulo(): void {
        $obj = new stdClass();
        $obj -> titulo="Megalodón";
        $obj -> contenido="La última película de Robert Ramirez que rompe records de taquilla.";
        $obj -> tipo="tecnologia";
        $obj -> id="3";
        $obj -> fecha="2024-02-29";
        $obj -> usuarioCreador="carlos";

        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->getArticulo(3);
        $articulos = [];
        $row = $resultado->fetch_object();
        // var_dump($row);
        $this->assertEquals($obj, $row);
    }

    public function testEditarArticulo(): void {
        $idArticulo = 1; 
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->editarArticulo($idArticulo);
        $this->assertNotNull($resultado);
        $this->assertInstanceOf(mysqli_result::class, $resultado);
    }

    public function testEliminarArticulo(): void {
        $idArticulo = 7; 
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->eliminarArticulo($idArticulo);
        $this->assertNotNull($resultado);
        $this->assertTrue($resultado);
    }

    // public function testIntroducirUsuario(): void {
    //     // Datos del usuario a insertar
    //     $usuarioFormulario = "usuario123";
    //     $contrasenia = "pass123";
    //     $email = "usuario123@test.com";
    
    //     // Crear una instancia de la clase que contiene la función introducirUsuario
    //     $publicaciones = new ConexionPublicaciones();
    
    //     // Llamar a la función introducirUsuario con los datos del usuario
    //     $resultado = $publicaciones->introducirUsuario($usuarioFormulario, $contrasenia, $email);
    
    //     // Verificar que el resultado no sea nulo
    //     $this->assertNotNull($resultado);
    
    //     // Verificar que el resultado sea verdadero (indicando que la inserción fue exitosa)
    //     $this->assertTrue($resultado);
    // }

    public function testGetUsuario() {
        $nombreUsuario = "usuario123"; // Cambia este valor por un nombre de usuario existente en tu base de datos

        // Crear una instancia de la clase que contiene la función getUsuario
        $publicaciones = new ConexionPublicaciones();

        // Llamar a la función getUsuario con el nombre de usuario
        $resultado = $publicaciones->getUsuario($nombreUsuario);

        // Verificar que el resultado no sea nulo
        $this->assertNotNull($resultado);

        // Verificar que el resultado sea un objeto mysqli_result
        $this->assertInstanceOf(mysqli_result::class, $resultado);

        // Verificar que el resultado contiene al menos una fila de datos (indicando que se encontró el usuario)
        $this->assertGreaterThan(0, $resultado->num_rows);
    }

    public function testGetUsuarios(): void {
        $publicaciones = new ConexionPublicaciones();
        $resultado = $publicaciones->getUsuarios();
        $this->assertNotNull($resultado);
    }


}

?>
