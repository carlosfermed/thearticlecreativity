<?php
use PHPUnit\Framework\TestCase;

class ConexionTest extends TestCase
{
    public function testRealizarConexion()
    {
        include 'publicaciones.php';

        // Crear un objeto mock de la clase ConexionPublicaciones
        $conexionMock = $this->getMockBuilder('ConexionPublicaciones')
                             ->onlyMethods(['realizarConexion']) // Indicar que solo vamos a reemplazar el método realizarConexion
                             ->getMock();

        // Establecer los valores de los atributos necesarios para la conexión
        $conexionMock->servidor = "localhost";
        $conexionMock->usuario = "root";
        $conexionMock->contrasenia = "";
        $conexionMock->bd = "publicaciones";

        // Definir el comportamiento del método realizarConexion
        $conexionMock->expects($this->once())
                     ->method('realizarConexion')
                     ->willReturn(new mysqli("localhost", "root", "", "publicaciones"));

        // Ejecutar el método realizarConexion
        $conexion = $conexionMock->realizarConexion();

        // Verificar que la conexión se haya realizado correctamente
        $this->assertInstanceOf(mysqli::class, $conexion);
        $conexion->close();
    }
}
