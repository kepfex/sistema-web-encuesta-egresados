<?php

namespace App\Livewire\Admin\Graduate;

use App\Models\Graduate;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Detalle de Encuesta'])]
class Show extends Component
{
    public Graduate $graduate;

    public function mount(Graduate $graduate)
    {
        // Cargamos todas las relaciones necesarias para la vista en una sola consulta.
        // Esto es MUY importante para el rendimiento.
        $this->graduate = $graduate->load([
            'programa', // La relación en el modelo Graduate
            'distritoResidencia.provincia.departamento', // Ubigeo de residencia
            'survey' => function ($query) {
                $query->with([
                    'distritoNacimiento.provincia.departamento', // Ubigeo de nacimiento
                    // Asegúrate de tener estas relaciones en tu modelo Survey.php
                    'dependienteEmpresaDistrito.provincia.departamento' 
                ]);
            }
        ]);
    }


    public function render()
    {
        // Pasamos el egresado ya cargado con todas sus relaciones a la vista
        return view('livewire.admin.graduate.show', [
            'survey' => $this->graduate->survey // Pasamos la encuesta como una variable separada por comodidad
        ]);
    }
}