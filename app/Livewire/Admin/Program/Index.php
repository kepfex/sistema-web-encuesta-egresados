<?php

namespace App\Livewire\Admin\Program;

use App\Models\Program;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app', ['title' => 'Programas de Estudio - Carreras'])]
class Index extends Component
{
    use WithPagination;
    
    public $paginarX = "5";
    public $search = '';

    public function updatingPaginarX()
    {
        $this->resetPage('programsPage');
    }
    public function updatingSearch()
    {
        $this->resetPage('programsPage');
    }

    // Metodo para eliminar
    #[On('delete-program')] // Escuchamos la accion enviado con dispatch
    public function deleteProgram($id)
    {

        $program = Program::find($id);

        if ($program) {

            $program->delete();

            // Enviamos un dispatch
            $this->dispatch(
                'notify',
                variant: 'success',
                title: '¡Eliminado!',
                message: 'El Programa de Estudio se eliminó correctamente.'
            );
        }
    }

    public function render()
    {
        $programs = Program::where('nombre', 'like', '%'.$this->search.'%')
            ->orderby('id', 'desc')->paginate($this->paginarX, ['*'], 'programsPage');

        return view('livewire.admin.program.index', [
            'programs' => $programs,
            'titulo' => 'Programas de Estudio',
        ]);
    }
}
