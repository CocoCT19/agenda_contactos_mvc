<?php
namespace App\Controladores;

use App\Nucleo\Controlador;
use App\Modelos\Contacto;

class ControladorContacto extends Controlador
{
    public function indice(): void
    {
        $this->requerirAutenticacion();
        $usuario = $_SESSION['usuario'];
        $contactos = Contacto::todosPorUsuario($usuario['id']);
        $this->vista('contactos/indice', [
            'titulo' => 'Mis Contactos',
            'contactos' => $contactos
        ]);
    }

    public function crear(): void
    {
        $this->requerirAutenticacion();
        $this->vista('contactos/crear', ['titulo' => 'Nuevo Contacto']);
    }

    public function guardar(): void
    {
        $this->requerirAutenticacion();
        $this->verificarCsrf();
        $usuario = $_SESSION['usuario'];

        $datos = [
            'usuario_id' => $usuario['id'],
            'nombre'     => trim($_POST['nombre'] ?? ''),
            'telefono'   => trim($_POST['telefono'] ?? ''),
            'correo'     => trim($_POST['correo'] ?? null),
            'direccion'  => trim($_POST['direccion'] ?? null),
        ];

        if (!$datos['nombre'] || !$datos['telefono']) {
            $_SESSION['error'] = 'Nombre y teléfono son obligatorios';
            $this->redireccionar('/agenda_contactos_mvc/publico/contactos/crear');
        }

       
        if (!empty($datos['correo']) && !filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'El correo no es válido';
            $this->redireccionar('/agenda_contactos_mvc/publico/contactos/crear');
        }

        
        if (Contacto::existePorCorreoOTelefono($usuario['id'], $datos['correo'], $datos['telefono'])) {
            $_SESSION['error'] = 'El correo o teléfono ya está registrado';
            $this->redireccionar('/agenda_contactos_mvc/publico/contactos/crear');
        }

        Contacto::crear($datos);
        $_SESSION['exito'] = 'Contacto creado';
        $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
    }

    public function editar(): void
    {
        $this->requerirAutenticacion();
        $usuario = $_SESSION['usuario'];
        $id = (int)($_GET['id'] ?? 0);

        $contacto = Contacto::buscar($id, $usuario['id']);
        if (!$contacto) {
            http_response_code(404);
            echo 'Contacto no encontrado';
            return;
        }

        $this->vista('contactos/editar', [
            'titulo' => 'Editar Contacto',
            'contacto' => $contacto
        ]);
    }

    public function actualizar(): void
    {
        $this->requerirAutenticacion();
        $this->verificarCsrf();
        $usuario = $_SESSION['usuario'];
        $id = (int)($_POST['id'] ?? 0);

        $datos = [
            'nombre'     => trim($_POST['nombre'] ?? ''),
            'telefono'   => trim($_POST['telefono'] ?? ''),
            'correo'     => trim($_POST['correo'] ?? null),
            'direccion'  => trim($_POST['direccion'] ?? null),
        ];

        if (!$datos['nombre'] || !$datos['telefono']) {
            $_SESSION['error'] = 'Nombre y teléfono son obligatorios';
            $this->redireccionar("/agenda_contactos_mvc/publico/contactos/editar?id=$id");
        }

        
        if (!empty($datos['correo']) && !filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'El correo no es válido';
            $this->redireccionar("/agenda_contactos_mvc/publico/contactos/editar?id=$id");
        }

        if (Contacto::existePorCorreoOTelefono($usuario['id'], $datos['correo'], $datos['telefono'], $id)) {
            $_SESSION['error'] = 'El correo o teléfono ya está registrado';
            $this->redireccionar("/agenda_contactos_mvc/publico/contactos/editar?id=$id");
        }

        Contacto::actualizar($id, $usuario['id'], $datos);
        $_SESSION['exito'] = 'Contacto actualizado';
        $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
    }

    public function eliminar(): void
    {
        $this->requerirAutenticacion();
        $this->verificarCsrf();
        $usuario = $_SESSION['usuario'];
        $id = (int)($_POST['id'] ?? 0);

        Contacto::eliminar($id, $usuario['id']);
        $_SESSION['exito'] = 'Contacto eliminado';
        $this->redireccionar('/agenda_contactos_mvc/publico/contactos');
    }
}
