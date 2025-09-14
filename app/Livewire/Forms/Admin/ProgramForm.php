<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Program;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProgramForm extends Form
{
    public ?Program $program = null;

    public $nombre = '';

    public function rules() {
        return [
            'nombre' => [
                'required',
                'string',
                'max:250',
                Rule::unique('programs', 'nombre')->ignore($this->program),
            ],
        ];
    }

    // Usado en edición
    public function setProgram(Program $program) {
        $this->program = $program;
        $this->nombre = $program->nombre;
    }


    public function store(): Program {
        $this->validate();
        return $program = Program::create($this->only([
            'nombre',
        ]));
    }

    public function update(): void {
        $this->validate();
        $this->program->update($this->all());
        $this->reset();
    }
}
