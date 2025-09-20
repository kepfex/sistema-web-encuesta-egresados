<?php

namespace App\Livewire\Admin\CurrentYear;

use App\Livewire\Forms\Admin\CurrentYearForm;
use App\Models\CurrentYear;
use Livewire\Component;

class Edit extends Component
{
    public CurrentYearForm $form;
    public CurrentYear $currentYear;

    public function mount(CurrentYear $currentYear)
    {
        $this->$currentYear = $currentYear;
        $this->form->setCurrentYear($currentYear);
    }

    public function save()
    {
        $this->form->update();

         // Prepara los datos para el toast
        $notification = [
            'variant' => 'success',
            'title'   => '¡Actualizado!',
            'message' => 'La Denominaión del Año Actual se actuzalizó correctamente.'
        ];

        // Envía la notificación a la sesión flash
        session()->flash('notify', $notification);

        // Redirige a la página del listado usando la navegación de Livewire
        $this->redirect(route('admin.current-years.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.current-year.form', [
            'breadcrumbsText' => 'Editar',
            'title' => 'Editar Denominación Año Actual Perú',
            'buttonText' => 'Guardar Cambios',
        ]);
    }
}
