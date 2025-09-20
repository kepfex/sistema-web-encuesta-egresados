<?php

namespace App\Livewire\Forms\Admin;

use App\Models\CurrentYear;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CurrentYearForm extends Form
{
    public ?CurrentYear $currentYear = null;

    #[Rule('required|string')]
    public $denominacion = '';

    // Usado en edición
    public function setCurrentYear(CurrentYear $currentYear) {
        $this->currentYear = $currentYear;
        $this->denominacion = $currentYear->denominacion;
    }

    public function update(): void {
        $this->validate();
        $this->currentYear->update($this->all());
        $this->reset();
    }
}
