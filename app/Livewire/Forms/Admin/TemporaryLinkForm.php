<?php

namespace App\Livewire\Forms\Admin;

use App\Models\TemporaryLink;
use Illuminate\Support\Str;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TemporaryLinkForm extends Form
{
    public ?TemporaryLink $temporaryLink = null;

    public $nombre_campania = '';
    public $fecha_expiracion = '';
    public $maximo_usos = 0;

    public function rules()
    {
        return [
            'nombre_campania' => ['required', 'string', 'max:255'],
            'fecha_expiracion' => ['nullable', 'date'],
            'maximo_usos' => ['required', 'integer', 'min:0'],
        ];
    }

    public function setTemporaryLink(TemporaryLink $temporaryLink)
    {
        $this->temporaryLink = $temporaryLink;
        $this->nombre_campania = $temporaryLink->nombre_campania;
        $this->fecha_expiracion = $temporaryLink->fecha_expiracion ? $temporaryLink->fecha_expiracion->format('Y-m-d') : '';
        $this->maximo_usos = $temporaryLink->maximo_usos;
    }

    public function store(): void
    {
        $this->validate();

        TemporaryLink::create([
            'nombre_campania' => $this->nombre_campania,
            'fecha_expiracion' => $this->fecha_expiracion ?: null,
            'maximo_usos' => $this->maximo_usos,
            'token' => Str::uuid(), // Generamos un token único universal
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $this->temporaryLink->update([
            'nombre_campania' => $this->nombre_campania,
            'fecha_expiracion' => $this->fecha_expiracion ?: null,
            'maximo_usos' => $this->maximo_usos,
        ]);
        
        $this->reset();
    }
}
