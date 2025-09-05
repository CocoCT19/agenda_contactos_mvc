<?php
namespace App\Controladores;

use App\Nucleo\Controlador;

class ControladorInicio extends Controlador
{
    public function indice(): void
    {
        $this->vista('inicio', ['titulo' => 'Inicio']);
    }
}
