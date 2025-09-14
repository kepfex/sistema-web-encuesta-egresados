<?php

namespace App\Livewire\Admin\Graduate;

use App\Models\Graduate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app', ['title' => 'Egresados - Encuestas'])]
class Index extends Component
{
    use WithPagination;
    
    public $paginarX = "5";
    public $search = '';

    public function updatingPaginarX()
    {
        $this->resetPage('graduatesPage');
    }
    public function updatingSearch()
    {
        $this->resetPage('graduatesPage');
    }

    // Metodo para eliminar
    #[On('delete-graduate')] // Escuchamos la accion enviado con dispatch
    public function deleteGraduate($id)
    {

        $graduate = Graduate::find($id);

        if ($graduate) {

            $graduate->delete();

            // Enviamos un dispatch
            $this->dispatch(
                'notify',
                variant: 'success',
                title: '¡Eliminado!',
                message: 'El Egresado y su Encuesta se eliminarón correctamente.'
            );
        }
    }

    public function render()
    {
        // Buscamos los egresados, incluyendo su programa de estudios para evitar consultas N+1.
        $graduates = Graduate::with('programa')
            ->where('nombre_completo', 'like', '%' . $this->search . '%')
            ->orWhere('dni', 'like', '%' . $this->search . '%')
            ->latest() // Ordena por los más recientes primero
            ->paginate($this->paginarX,  ['*'], 'graduatesPage');
        return view('livewire.admin.graduate.index', [
            'graduates' => $graduates,
            'titulo' => 'Egresados Registrados',
        ]);
    }
}
