<?php

namespace App\Livewire\Admin\TemporaryLink;

use App\Livewire\Forms\Admin\TemporaryLinkForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Crear - Enlace para Encuestas'])]
class Create extends Component
{
    public TemporaryLinkForm $form;

    public function save()
    {
        $this->form->store();
        session()->flash('notify', [
            'variant' => 'success',
            'title'   => '¡Creado!',
            'message' => 'El Enlace para Encuestas se creó correctamente.'
        ]);
        $this->redirect(route('admin.temporary-links.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.temporary-link.form', [
            'breadcrumbsText' => 'Nuevo Enlace',
            'title' => 'Crear Enlace para Encuestas',
            'buttonText' => 'Guardar',
        ]);
    }
}
