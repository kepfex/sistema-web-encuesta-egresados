<?php

namespace App\Livewire\Admin\TemporaryLink;

use App\Models\TemporaryLink;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app', ['title' => 'Enlaces para encuestas'])]
class Index extends Component
{
    use WithPagination;
    
    public $paginarX = "10";
    public $search = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPaginarX() { $this->resetPage(); }

    #[On('delete-temporary-link')]
    public function deleteTemporaryLink($id)
    {
        $link = TemporaryLink::find($id);
        if ($link) {
            $link->delete();
            $this->dispatch('notify', variant: 'success', title: '¡Eliminado!', message: 'El enlace se eliminó correctamente.');
        }
    }

    public function render()
    {
        $temporaryLinks = TemporaryLink::where('nombre_campania', 'like', '%'.$this->search.'%')
            ->orWhere('token', 'like', '%'.$this->search.'%')
            ->orderby('id', 'desc')
            ->paginate($this->paginarX);

        return view('livewire.admin.temporary-link.index', [
            'temporaryLinks' => $temporaryLinks,
            'titulo' => 'Enlaces para Encuestas',
        ]);
    }
}
