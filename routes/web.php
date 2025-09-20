<?php

use App\Http\Controllers\PDFController;
use App\Http\Middleware\ValidateSurveyToken;
use App\Livewire\Admin\Program\Index as ProgramIndex;
use App\Livewire\Admin\Program\Create as ProgramCreate;
use App\Livewire\Admin\Program\Edit as ProgramEdit;
use App\Livewire\Admin\Graduate\Index as GraduateIndex;
use App\Livewire\Admin\Graduate\Show as GraduateShow;
use App\Livewire\Admin\Graduate\Create as GraduateCreate;
use App\Livewire\Admin\Graduate\Edit as GraduateEdit;
use App\Livewire\Admin\TemporaryLink\Index as TemporaryLinkIndex;
use App\Livewire\Admin\TemporaryLink\Create as TemporaryLinkCreate;
use App\Livewire\Admin\TemporaryLink\Edit as TemporaryLinkEdit;
use App\Livewire\Admin\CurrentYear\Index as CurrentYearIndex;
use App\Livewire\Admin\CurrentYear\Edit as CurrentYearEdit;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Survey\SurveyForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Rutas para Programas de Estudio
        Route::get('programs', ProgramIndex::class)->name('programs.index');
        Route::get('programs/create', ProgramCreate::class)->name('programs.create');
        Route::get('programs/{program}/edit', ProgramEdit::class)->name('programs.edit');

        // Rutas para Egresados
        Route::get('graduates', GraduateIndex::class)->name('graduates.index');
        Route::get('graduates/create', GraduateCreate::class)->name('graduates.create');
        Route::get('graduates/{graduate}/edit', GraduateEdit::class)->name('graduates.edit');

        // Rutas para Enlaces Temporales
        Route::get('temporary-links', TemporaryLinkIndex::class)->name('temporary-links.index');
        Route::get('temporary-links/create', TemporaryLinkCreate::class)->name('temporary-links.create');
        Route::get('temporary-links/{temporaryLink}/edit', TemporaryLinkEdit::class)->name('temporary-links.edit');

        // Rutas para Denominación del año 
        Route::get('current-years', CurrentYearIndex::class)->name('current-years.index');
        Route::get('current-years/{currentYear}/edit', CurrentYearEdit::class)->name('current-years.edit');

        // Rutas para Egresados
        Route::get('graduates', GraduateIndex::class)->name('graduates.index');
        Route::get('graduates/{graduate}', GraduateShow::class)->name('graduates.show'); // Ruta para ver el detalle
    });

// RUTA PÚBLICA PARA LA ENCUESTA
Route::get('/encuesta/{token}', SurveyForm::class)
    ->middleware(ValidateSurveyToken::class) // <-- La capa de seguridad
    ->name('encuesta.show');

// Ruta final a la que se redirige tras enviar la encuesta
Route::get('/encuesta/completada/gracias', function () {
    // Esta línea le dice a Laravel que busque el archivo en 'resources/views/survey/thank-you.blade.php'
    return view('livewire.survey.thank-you');
})->name('encuesta.gracias');


// Rutas para pdf
Route::middleware(['auth'])->get('/graduates/{graduate}/survey/pdf', [PDFController::class, 'graduateSurvey'])
    ->name('graduates.survey.pdf');
    
require __DIR__ . '/auth.php';
