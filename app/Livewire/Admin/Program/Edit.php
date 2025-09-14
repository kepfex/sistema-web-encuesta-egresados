<?php

namespace App\Livewire\Admin\Program;

use App\Livewire\Forms\Admin\ProgramForm;
use App\Models\Program;
use Livewire\Component;

class Edit extends Component
{
    public ProgramForm $form;
    public Program $program;

    public function mount(Program $program)
    {
        $this->program = $program;
        $this->form->setProgram($program);
    }

    public function save()
    {
        $this->form->update();

         // Prepara los datos para el toast
        $notification = [
            'variant' => 'success',
            'title'   => '¡Actualizado!',
            'message' => 'El Programa de Estudio se actuzalizó correctamente.'
        ];

        // Envía la notificación a la sesión flash
        session()->flash('notify', $notification);

        // Redirige a la página del listado usando la navegación de Livewire
        $this->redirect(route('admin.programs.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.program.form', [
            'breadcrumbsText' => 'Editar',
            'title' => 'Editar Programa de Estudio',
            'buttonText' => 'Guardar Cambios',
        ]);
    }
}
