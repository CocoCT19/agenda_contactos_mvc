<?php
namespace App\Nucleo;

class Enrutador
{
    private array $rutas = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $ruta, callable|array $accion): void
    {
        $this->rutas['GET'][$ruta] = $accion;
    }

    public function post(string $ruta, callable|array $accion): void
    {
        $this->rutas['POST'][$ruta] = $accion;
    }

    public function despachar(): void
    {
        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        $nombreScript = dirname($_SERVER['SCRIPT_NAME']);
        if ($nombreScript !== '/' && str_starts_with($uri, $nombreScript)) {
            $uri = substr($uri, strlen($nombreScript));
        }
        $uri = rtrim($uri, '/') ?: '/';

        $accion = $this->rutas[$metodo][$uri] ?? null;

        if (!$accion) {
            http_response_code(404);
            echo "404 - Ruta no encontrada";
            return;
        }

        if (is_array($accion)) {
            [$clase, $metodoAccion] = $accion;
            $controlador = new $clase();
            $controlador->$metodoAccion();
            return;
        }

        call_user_func($accion);
    }
}
