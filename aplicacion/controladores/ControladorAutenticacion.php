<?php
namespace App\Controladores;

use App\Nucleo\Controlador;
use App\Modelos\Usuario;

class ControladorAutenticacion extends Controlador
{
    public function mostrarFormularioIniciarSesion(): void
    {
        if ($this->estaAutenticado()) {
            $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
        }
        $this->vista('autenticacion/iniciar-sesion', ['titulo' => 'Iniciar sesión']);
    }

    public function iniciarSesion(): void
    {
        $this->verificarCsrf();
        $correo = trim($_POST['correo'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';

        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'El correo no es válido';
            $this->redireccionar('/agenda_contactos_mvc/publico/iniciar-sesion');
        }

        $usuario = Usuario::buscarPorCorreo($correo);
        if (!$usuario || !password_verify($contrasena, $usuario->contrasena)) {
            $_SESSION['error'] = 'Credenciales inválidas';
            $this->redireccionar('/agenda_contactos_mvc/publico/iniciar-sesion');
        }

        $_SESSION['usuario'] = [
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'correo' => $usuario->correo
        ];
        $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
    }

    public function mostrarFormularioRegistro(): void
    {
        if ($this->estaAutenticado()) {
            $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
        }
        $this->vista('autenticacion/registro', ['titulo' => 'Crear cuenta']);
    }

    public function registrar(): void
    {
        $this->verificarCsrf();
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';
        $confirmacion = $_POST['confirmar_contrasena'] ?? '';

        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'El correo no es válido';
            $this->redireccionar('/agenda_contactos_mvc/publico/registro');
        }

        if (!$nombre || !$correo || !$contrasena || $contrasena !== $confirmacion) {
            $_SESSION['error'] = 'Datos inválidos o contraseñas no coinciden';
            $this->redireccionar('/agenda_contactos_mvc/publico/registro');
        }

        if (Usuario::existePorCorreo($correo)) {
            $_SESSION['error'] = 'El correo ya está registrado';
            $this->redireccionar('/agenda_contactos_mvc/publico/registro');
        }

        $id = Usuario::crear($nombre, $correo, $contrasena);
        $_SESSION['usuario'] = ['id' => $id, 'nombre' => $nombre, 'correo' => $correo];
        $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
    }

    public function cerrarSesion(): void
    {
        $this->verificarCsrf();
        session_destroy();
        session_start();
        $this->redireccionar('/agenda_contactos_mvc/publico/iniciar-sesion');
    }
}
