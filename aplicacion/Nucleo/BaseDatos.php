<?php
namespace App\Nucleo;

use PDO;
use PDOException;

class BaseDatos
{
    private static ?PDO $instancia = null;

    public static function obtenerInstancia(): PDO
    {
        if (self::$instancia === null) {
            $controlador = $_ENV['DB_CONTROLADOR'] ?? 'mysql';
            $servidor = $_ENV['DB_SERVIDOR'] ?? '127.0.0.1';
            $puerto = $_ENV['DB_PUERTO'] ?? '3306';
            $nombreBD = $_ENV['DB_NOMBRE'] ?? 'agenda_contactos';
            $codificacion = $_ENV['DB_CODIFICACION'] ?? 'utf8mb4';
            $usuario = $_ENV['DB_USUARIO'] ?? 'root';
            $clave = $_ENV['DB_CLAVE'] ?? '1234';

            $dsn = sprintf(
                '%s:host=%s;port=%s;dbname=%s;charset=%s',
                $controlador,
                $servidor,
                $puerto,
                $nombreBD,
                $codificacion
            );

            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$instancia = new PDO($dsn, $usuario, $clave, $opciones);
            } catch (PDOException $e) {
                die('❌ Error en la conexión a la base de datos: ' . $e->getMessage());
            }
        }

        return self::$instancia;
    }
}
