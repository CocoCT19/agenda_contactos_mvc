<?php
namespace App\Nucleo;

class Controlador
{
    protected function vista(string $plantilla, array $datos = []): void
    {
        extract($datos);
        $baseUrl = $_ENV['APP_URL'] ?? '';
        $template = $plantilla; 
        include __DIR__ . '/../../vistas/plantilla.php';
    }

    protected function estaAutenticado(): bool
    {
        return isset($_SESSION['usuario']);
    }

    protected function requerirAutenticacion(): void
    {
        if (!$this->estaAutenticado()) {
            $this->redireccionar('/agenda_contactos_mvc/publico/iniciar-sesion');
        }
    }

    protected function redireccionar(string $ruta): void
    {
        $urlBase = $_ENV['APP_URL'] ?? '';
        header("Location: {$urlBase}{$ruta}");
        exit;
    }

    protected function generarTokenCsrf(): string
    {
        if (empty($_SESSION['_token'])) {
            $_SESSION['_token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['_token'];
    }

protected function verificarCsrf(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? '';
            if (!$token || !hash_equals($_SESSION['_token'] ?? '', $token)) {
                http_response_code(419);
                die('❌ El token CSRF no coincide.');
            }
        }
    }
}
