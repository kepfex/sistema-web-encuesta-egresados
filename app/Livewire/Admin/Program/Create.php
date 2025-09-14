<?php

namespace App\Livewire\Admin\Program;

use App\Livewire\Forms\Admin\ProgramForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Crear Programa de Estudio'])]
class Create extends Component
{
    public ProgramForm $form;

    public function save() {
        $this->form->store();

        // Prepara los datos para el toast
        $notification = [
            'variant' => 'success',
            'title'   => '¡Creado!',
            'message' => 'El Programa de Estudio se creó correctamente.'
        ];

        // Envía la notificación a la sesión flash
        session()->flash('notify', $notification);

        // Redirige a la página del listado usando la navegación de Livewire
        $this->redirect(route('admin.programs.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.program.form', [
            'breadcrumbsText' => 'Nuevo',
            'title' => 'Crear Programa de Estudio',
            'buttonText' => 'Guardar',
        ]);
    }
}
