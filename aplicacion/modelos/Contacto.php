<?php
namespace App\Modelos;

use App\Nucleo\BaseDatos;
use PDO;

class Contacto
{
    public int $id;
    public int $usuario_id;
    public string $nombre;
    public string $telefono;
    public ?string $correo;
    public ?string $direccion;

    public static function todosPorUsuario(int $usuario_id): array
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('SELECT * FROM contactos WHERE usuario_id = ? ORDER BY nombre ASC');
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function buscar(int $id, int $usuario_id): ?self
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('SELECT * FROM contactos WHERE id = ? AND usuario_id = ? LIMIT 1');
        $stmt->execute([$id, $usuario_id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) return null;
        return self::mapear($fila);
    }

    public static function crear(array $datos): int
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('INSERT INTO contactos (usuario_id, nombre, telefono, correo, direccion) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $datos['usuario_id'],
            $datos['nombre'],
            $datos['telefono'],
            $datos['correo'] ?? null,
            $datos['direccion'] ?? null
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function actualizar(int $id, int $usuario_id, array $datos): void
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('UPDATE contactos SET nombre = ?, telefono = ?, correo = ?, direccion = ? WHERE id = ? AND usuario_id = ?');
        $stmt->execute([
            $datos['nombre'],
            $datos['telefono'],
            $datos['correo'] ?? null,
            $datos['direccion'] ?? null,
            $id,
            $usuario_id
        ]);
    }

    public static function eliminar(int $id, int $usuario_id): void
    {
        $pdo = BaseDatos::obtenerInstancia();
        $stmt = $pdo->prepare('DELETE FROM contactos WHERE id = ? AND usuario_id = ?');
        $stmt->execute([$id, $usuario_id]);
    }
    public static function existePorCorreoOTelefono(int $usuario_id, ?string $correo, ?string $telefono, ?int $excluirId = null): bool
    {
        $pdo = BaseDatos::obtenerInstancia();
        $consulta = 'SELECT COUNT(*) FROM contactos WHERE usuario_id = ?';
        $parametros = [$usuario_id];

        if ($correo) {
            $consulta .= ' AND LOWER(correo) = LOWER(?)';
            $parametros[] = trim($correo);
        }

        if ($telefono) {
            $consulta .= ' AND telefono = ?';
            $parametros[] = trim($telefono);
        }

        if ($excluirId) {
            $consulta .= ' AND id != ?';
            $parametros[] = $excluirId;
        }

        $stmt = $pdo->prepare($consulta);
        $stmt->execute($parametros);
        return (int)$stmt->fetchColumn() > 0;
    }

    private static function mapear(array $fila): self
    {
        $c = new self();
        $c->id = (int)$fila['id'];
        $c->usuario_id = (int)$fila['usuario_id'];
        $c->nombre = $fila['nombre'];
        $c->telefono = $fila['telefono'];
        $c->correo = $fila['correo'] ?? null;
        return $c;
    }
}
