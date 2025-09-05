<?php
namespace App\Modelos;

use App\Nucleo\BaseDatos;
use PDO;

class Usuario
{
    public int $id;
    public string $nombre;
    public string $correo;
    public string $contrasena;
    public string $creado_en;

   
    public static function buscarPorCorreo(string $correo): ?self
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE LOWER(correo) = LOWER(?) LIMIT 1');
        $stmt->execute([trim($correo)]);
        $fila = $stmt->fetch();
        if (!$fila) return null;
        return self::mapear($fila);
    }

   
    public static function buscar(int $id): ?self
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $fila = $stmt->fetch();
        if (!$fila) return null;
        return self::mapear($fila);
    }

    public static function crear(string $nombre, string $correo, string $contrasena): int
    {
        $pdo = BaseDatos::obtenerInstancia();
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)');
        $stmt->execute([$nombre, $correo, $hash]);
        return (int)$pdo->lastInsertId();
    }

    public static function existePorCorreo(string $correo): bool
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE LOWER(correo) = LOWER(?)');
        $stmt->execute([trim($correo)]);
        return (int)$stmt->fetchColumn() > 0;
    }

    private static function mapear(array $fila): self
    {
        $u = new self();
        $u->id = (int)$fila['id'];
        $u->nombre = $fila['nombre'];
        $u->correo = $fila['correo'];
        $u->contrasena = $fila['contrasena'];
        $u->creado_en = $fila['creado_en'] ?? '';
        return $u;
    }
}
