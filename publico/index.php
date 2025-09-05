<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Nucleo\Enrutador;
use App\Nucleo\BaseDatos;
use Dotenv\Dotenv;

session_start();

$raiz = dirname(__DIR__);
if (file_exists($raiz . '/.env')) {
    $dotenv = Dotenv::createImmutable($raiz);
    $dotenv->load();
}

$enrutador = new Enrutador();


$enrutador->get('/', [App\Controladores\ControladorInicio::class, 'indice']);
$enrutador->get('/iniciar-sesion', [App\Controladores\ControladorAutenticacion::class, 'mostrarFormularioIniciarSesion']);
$enrutador->post('/iniciar-sesion', [App\Controladores\ControladorAutenticacion::class, 'iniciarSesion']);
$enrutador->get('/registro', [App\Controladores\ControladorAutenticacion::class, 'mostrarFormularioRegistro']);
$enrutador->post('/registro', [App\Controladores\ControladorAutenticacion::class, 'registrar']);
$enrutador->post('/cerrar-sesion', [App\Controladores\ControladorAutenticacion::class, 'cerrarSesion']);


$enrutador->get('/contactos', [App\Controladores\ControladorContacto::class, 'indice']);
$enrutador->get('/contactos/crear', [App\Controladores\ControladorContacto::class, 'crear']);
$enrutador->post('/contactos/guardar', [App\Controladores\ControladorContacto::class, 'guardar']);
$enrutador->get('/contactos/editar', [App\Controladores\ControladorContacto::class, 'editar']); // ?id=
$enrutador->post('/contactos/actualizar', [App\Controladores\ControladorContacto::class, 'actualizar']); // id via hidden
$enrutador->post('/contactos/eliminar', [App\Controladores\ControladorContacto::class, 'eliminar']); // id via hidden

$enrutador->despachar();
