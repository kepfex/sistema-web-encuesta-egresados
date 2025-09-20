<?php

namespace App\Livewire\Admin\CurrentYear;

use App\Models\CurrentYear;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app', ['title' => 'Denominación Año Actual Perú'])]
class Index extends Component
{
    use WithPagination;
    
    public $paginarX = "10";
    public $search = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingPaginarX() { $this->resetPage(); }
    
    public function render()
    {
        $denominacions = CurrentYear::where('denominacion', 'like', '%'.$this->search.'%')
            ->orderby('id', 'desc')
            ->paginate($this->paginarX);

        return view('livewire.admin.current-year.index', [
            'denominacions' => $denominacions,
            'titulo' => 'Denominación Año Actual en Perú',
        ]);
    }
}
