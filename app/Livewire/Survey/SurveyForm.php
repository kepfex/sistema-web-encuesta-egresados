<?php

namespace App\Livewire\Survey;

use App\Models\Department;
use App\Models\District;
use App\Models\Graduate;
use App\Models\Program;
use App\Models\Province;
use App\Models\TemporaryLink;
use App\Rules\Recaptcha;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class SurveyForm extends Component
{
    public TemporaryLink $link;
    public $recaptcha_token;

    public int $currentStep = 1;
    public int $totalSteps = 8;

    // --- Paso 1: Identificación ---
    public $correo_electronico = '';
    public $nombre_completo = '';
    public $dni = '';
    public $numero_celular = '';
    public $programa_id = '';
    public $anio_egreso = '';
    public $fecha_titulacion = '';

    // --- Paso 2: Residencia (guardamos en graduates) ---
    public $direccion_residencia = '';
    public $residencia_departamento_id = '';
    public $residencia_provincia_id = '';
    public $residencia_distrito_id = '';

    // --- Paso 3: Datos Personales ---
    public $edad = '';
    public $sexo = '';
    public $fecha_nacimiento = '';
    public $nacimiento_departamento_id = '';
    public $nacimiento_provincia_id = '';
    public $nacimiento_distrito_id = '';

    // --- Paso 4: Actividad Laboral ---
    public $desempeno_post_egreso = null;
    public $desempeno_post_titulacion = null;
    public $tiempo_sin_trabajar_egreso = '';
    public $tiempo_sin_trabajar_titulacion = '';

    public $desempeno_en_su_area = null;
    public $condicion_laboral = '';
    public $remuneracion_mensual = '';
    public $motivo_no_ejerce_carrera = '';

    public bool $es_independiente = false;
    public bool $es_dependiente = false;
    public bool $no_aplica_empleo = false;

    public $independiente_descripcion = '';

    public $dependiente_empresa_nombre = '';
    public $dependiente_empresa_direccion = '';
    public $dependiente_empresa_departamento_id = '';
    public $dependiente_empresa_provincia_id = '';
    public $dependiente_empresa_distrito_id = '';
    public $dependiente_empresa_tipo = '';
    public $dependiente_empresa_ruc = '';
    public $dependiente_empresa_rubro = '';
    public $dependiente_empresa_jefe = '';
    public $dependiente_cargo = '';
    public $dependiente_fecha_ingreso = '';
    public $dependiente_condicion_cargo = '';
    public $condicion_formalidad = '';

    public $tipo_empleo_general;

    // --- Paso 5: Evaluación formación ---
    public $calificacion_formacion = '';
    public $utilidad_contenido = '';
    public $satisfaccion_formacion = '';

    // --- Paso 6: Medios de contacto ---
    public $medio_contacto_preferido = '';
    public $disponibilidad_dias = '';
    public $disponibilidad_horarios = [];

    // --- Paso 7: Otras actividades ---
    public $otra_actividad_descripcion = '';
    public bool $sin_otra_actividad = false;
    public $estudia_otra_carrera = null;
    public $otra_carrera_nombre = '';
    public $otra_carrera_institucion = '';
    public $otra_carrera_tipo_institucion = '';

    // --- Paso 8: Sugerencias ---
    public $sugerencias = '';

    // --- Propiedades para popular los <select> ---
    public $programas = [];
    public $departamentos = [];
    public $provinciasResidencia = [];
    public $distritosResidencia = [];
    public $provinciasNacimiento = [];
    public $distritosNacimiento = [];
    public $provinciasEmpresa = [];
    public $distritosEmpresa = [];

    public function mount(string $token)
    {
        $this->link = TemporaryLink::where('token', $token)->firstOrFail();
        $this->programas = Program::orderBy('nombre')->get();
        $this->departamentos = Department::orderBy('departamento')->get();
    }

    /* --------------------
       Navegación
    -------------------- */
    // public function nextStep()
    // {
    //     $this->validateStep($this->currentStep);
    //     if ($this->currentStep < $this->totalSteps) $this->currentStep++;
    // }
    public function nextStep()
    {
        try {
            $this->validateStep($this->currentStep);
            if ($this->currentStep < $this->totalSteps) $this->currentStep++;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->addError('step_' . $this->currentStep, 'Revisa los campos de este paso.');
            throw $e;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) $this->currentStep--;
    }

    // --- Lógica de Validación por Pasos ---

    /* --------------------
       Validaciones por paso
    -------------------- */
    public function validateStep(int $step)
    {
        $currentYear = Carbon::now()->year;

        $rules = [
            1 => [
                'correo_electronico' => 'required|email|max:255|unique:graduates,correo_electronico',
                'nombre_completo' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
                'dni' => 'required|digits:8|unique:graduates,dni',
                'numero_celular' => 'required|digits:9|regex:/^9[0-9]{8}$/',
                'programa_id' => 'required|exists:programs,id',
                'anio_egreso' => "required|digits:4|integer|min:1980|max:" . ($currentYear - 1),
                'fecha_titulacion' => 'required|nullable|date',
            ],
            2 => [
                'direccion_residencia' => 'required|string|max:255',
                'residencia_distrito_id' => 'required|exists:districts,idDistrito',
            ],
            3 => [
                'edad' => 'required|integer|min:15|max:100',
                'sexo' => 'required|string|max:50',
                'fecha_nacimiento' => 'required|date',
                'nacimiento_distrito_id' => 'required|exists:districts,idDistrito',
            ],
            4 => [
                'desempeno_post_egreso' => 'required|in:0,1',
                'desempeno_post_titulacion' => 'required|in:0,1',
                'tiempo_sin_trabajar_egreso' => 'required|string|max:255',
                'tiempo_sin_trabajar_titulacion' => 'required|string|max:255',

                // // Mantengo el antiguo si lo usas en otras partes
                // 'desempeno_en_su_area' => 'required|in:0,1',

                'condicion_laboral' => 'required|in:laborando,no laborando',
                'motivo_no_ejerce_carrera' => 'required_if:condicion_laboral,no laborando|string|max:1000',

                'remuneracion_mensual' => 'required_if:condicion_laboral,laborando|numeric|min:0',

                // Validación que exige al menos un checkbox si está laborando
                'tipo_empleo_general' => [
                    Rule::requiredIf(function () {
                        return $this->condicion_laboral === 'laborando' &&
                            !$this->es_independiente &&
                            !$this->es_dependiente &&
                            !$this->no_aplica_empleo;
                    }),
                ],

                // Independiente
                'independiente_descripcion' => 'required_if:es_independiente,true|string|max:500',

                // Dependiente + ubigeo de la empresa (usar las propiedades que sí declaraste)
                'dependiente_empresa_nombre' => 'required_if:es_dependiente,true|string|max:255',
                'dependiente_empresa_direccion' => 'required_if:es_dependiente,true|string|max:255',
                'dependiente_empresa_departamento_id' => 'required_if:es_dependiente,true|exists:departments,idDepartamento',
                'dependiente_empresa_provincia_id' => 'required_if:es_dependiente,true|exists:provinces,idProvincia',
                'dependiente_empresa_distrito_id' => 'required_if:es_dependiente,true|exists:districts,idDistrito',
                'dependiente_empresa_tipo' => 'required_if:es_dependiente,true|string|max:255',
                'dependiente_empresa_ruc' => 'required_if:es_dependiente,true|string|max:20',
                'dependiente_empresa_rubro' => 'required_if:es_dependiente,true|string|max:255',
                'dependiente_empresa_jefe' => 'required_if:es_dependiente,true|string|max:255',

                'dependiente_cargo' => 'required_if:es_dependiente,true|string|max:255',

                'dependiente_fecha_ingreso' => [
                    'required_if:es_dependiente,true',
                    'date',
                    'before_or_equal:today',
                    function ($attribute, $value, $fail) {
                        if (!empty($value) && !empty($this->anio_egreso)) {
                            if (intval(date('Y', strtotime($value))) < intval($this->anio_egreso)) {
                                $fail('La fecha de ingreso no puede ser anterior al año de egreso.');
                            }
                        }
                    },
                ],

                'dependiente_condicion_cargo' => 'required_if:es_dependiente,true|in:nombrado,contratado,temporal',

                'condicion_formalidad' => 'required_if:es_dependiente,true|in:formal,informal',
            ],
            5 => [
                'calificacion_formacion' => 'required|in:muy_apropiada,apropiada,regularmente_apropiada,inapropiada',
                'utilidad_contenido' => 'required|in:si,no,a medias',
                'satisfaccion_formacion' => 'required|integer|min:1|max:5',
            ],
            6 => [
                'medio_contacto_preferido' => 'nullable|in:correo,whatsapp,facebook,llamada,otro',
                'disponibilidad_dias' => 'nullable|string|max:255',
                'disponibilidad_horarios' => 'nullable|sometimes',
            ],
            7 => [
                'otra_actividad_descripcion' => 'nullable|string|max:1000',
                'sin_otra_actividad' => 'boolean',
                'estudia_otra_carrera' => 'required|boolean',
                'otra_carrera_nombre' => 'required_if:estudia_otra_carrera,true|string|max:255',
                'otra_carrera_institucion' => 'nullable|string|max:255',
                'otra_carrera_tipo_institucion' => 'nullable|in:instituto_tecnologico,instituto_pedagogico,universidad',
            ],
            8 => [
                'sugerencias' => 'nullable|string|max:1000',
            ],
        ];

        $this->validate($rules[$step]);
    }

    // --- Lógica de Selects Dependientes (Ubigeo) ---
    public function updatedResidenciaDepartamentoId($value)
    {
        $this->provinciasResidencia = Province::where('idDepartamento', $value)->orderBy('provincia')->get();
        $this->reset('residencia_provincia_id', 'residencia_distrito_id');
    }
    public function updatedResidenciaProvinciaId($value)
    {
        $this->distritosResidencia = District::where('idProvincia', $value)->orderBy('distrito')->get();
        $this->reset('residencia_distrito_id');
    }
    public function updatedNacimientoDepartamentoId($value)
    {
        $this->provinciasNacimiento = Province::where('idDepartamento', $value)->orderBy('provincia')->get();
        $this->reset('nacimiento_provincia_id', 'nacimiento_distrito_id');
    }
    public function updatedNacimientoProvinciaId($value)
    {
        $this->distritosNacimiento = District::where('idProvincia', $value)->orderBy('distrito')->get();
        $this->reset('nacimiento_distrito_id');
    }
    public function updatedDependienteEmpresaDepartamentoId($value)
    {
        $this->provinciasEmpresa = Province::where('idDepartamento', $value)->orderBy('provincia')->get();
        $this->reset('dependiente_empresa_provincia_id', 'dependiente_empresa_distrito_id');
    }
    public function updatedDependienteEmpresaProvinciaId($value)
    {
        $this->distritosEmpresa = District::where('idProvincia', $value)->orderBy('distrito')->get();
        $this->reset('dependiente_empresa_distrito_id');
    }

    /* --------------------
       Lógica checkboxes
    -------------------- */
    public function updatedSinOtraActividad($value)
    {
        if ($value) {
            $this->reset('otra_actividad_descripcion');
        }
    }

    public function updatedEsIndependiente($value)
    {
        if ($value) {
            $this->no_aplica_empleo = false;
        } else {
            $this->reset('independiente_descripcion');
        }
    }

    public function updatedEsDependiente($value)
    {
        if ($value) {
            $this->no_aplica_empleo = false;
        } else {
            $this->reset(
                'dependiente_empresa_nombre',
                'dependiente_cargo',
                'dependiente_fecha_ingreso',
                'dependiente_condicion_cargo',
                'dependiente_empresa_direccion',
                'dependiente_empresa_distrito_id',
                'dependiente_empresa_provincia_id',
                'dependiente_empresa_departamento_id',
                'dependiente_empresa_tipo',
                'dependiente_empresa_ruc',
                'dependiente_empresa_rubro',
                'dependiente_empresa_jefe'
            );
        }
    }

    public function updatedNoAplicaEmpleo($value)
    {
        if ($value) {
            $this->es_independiente = false;
            $this->es_dependiente = false;
            $this->reset(
                'independiente_descripcion',
                'dependiente_empresa_nombre',
                'dependiente_cargo',
                'dependiente_fecha_ingreso',
                'dependiente_condicion_cargo',
                'dependiente_empresa_direccion',
                'dependiente_empresa_distrito_id',
                'dependiente_empresa_provincia_id',
                'dependiente_empresa_departamento_id',
                'dependiente_empresa_tipo',
                'dependiente_empresa_ruc',
                'dependiente_empresa_rubro',
                'dependiente_empresa_jefe'
            );
        }
    }

    protected function validateRecaptcha()
    {
        $this->validate([
            'recaptcha_token' => ['required', new Recaptcha('submit', 0.5)],
        ]);
    }

    // --- Lógica de Guardado Final ---
    public function submit($token)
    {
        $this->recaptcha_token = $token;

        $this->validateStep(8); // Valida el último paso
        $this->validateRecaptcha();

        // dd($this->recaptcha_token); // Para debuggear la respuesta de Google

        // Ejecuta la transacción para guardar en la base de datos
        DB::transaction(function () {
            // 1) Crear o recuperar egresado (no actualizamos si ya existe)
            $egresado = Graduate::firstOrCreate(
                ['dni' => $this->dni],
                [
                    'program_id' => $this->programa_id,
                    'residencia_distrito_id' => $this->residencia_distrito_id ?: null,
                    'nombre_completo' => $this->nombre_completo,
                    'correo_electronico' => $this->correo_electronico,
                    'numero_celular' => $this->numero_celular ?: null,
                    'anio_egreso' => $this->anio_egreso,
                    'fecha_titulacion' => $this->fecha_titulacion ?: null,
                    'direccion_residencia' => $this->direccion_residencia ?: null,
                ]
            );

            // 2. Verificar si ya respondió encuesta
            $encuestaExistente = $egresado->survey()->first();
            if ($encuestaExistente) {
                // Evita duplicar incrementos en usos_actuales
                return;
            }

            // 3. Transformar horarios si vienen como string
            // transformar el string en array antes de guardar.
            $horarios = $this->disponibilidad_horarios;
            if (is_string($horarios)) {
                $horarios = array_map('trim', explode(',', $horarios));
            }

            // 4. Crear la encuesta
            $egresado->survey()->create([
                'edad' => $this->edad ?: null,
                'sexo' => $this->sexo ?: null,
                'fecha_nacimiento' => $this->fecha_nacimiento ?: null,
                'nacimiento_distrito_id' => $this->nacimiento_distrito_id ?: null,

                'desempeno_post_egreso' => $this->desempeno_post_egreso,
                'desempeno_post_titulacion' => $this->desempeno_post_titulacion,
                'tiempo_sin_trabajar_egreso' => $this->tiempo_sin_trabajar_egreso ?: null,
                'tiempo_sin_trabajar_titulacion' => $this->tiempo_sin_trabajar_titulacion ?: null,

                'desempeno_en_su_area' => $this->desempeno_en_su_area,
                'condicion_laboral' => $this->condicion_laboral ?: null,
                'remuneracion_mensual' => $this->remuneracion_mensual ?: null,
                'motivo_no_ejerce_carrera' => $this->motivo_no_ejerce_carrera ?: null,

                'es_independiente' => $this->es_independiente,
                'es_dependiente' => $this->es_dependiente,
                'no_aplica_empleo' => $this->no_aplica_empleo,

                'independiente_descripcion' => $this->independiente_descripcion ?: null,
                'dependiente_empresa_nombre' => $this->dependiente_empresa_nombre ?: null,
                'dependiente_empresa_direccion' => $this->dependiente_empresa_direccion ?: null,
                'dependiente_empresa_distrito_id' => $this->dependiente_empresa_distrito_id ?: null,
                'dependiente_empresa_provincia_id' => $this->dependiente_empresa_provincia_id ?: null,
                'dependiente_empresa_departamento_id' => $this->dependiente_empresa_departamento_id ?: null,
                'dependiente_empresa_tipo' => $this->dependiente_empresa_tipo ?: null,
                'dependiente_empresa_ruc' => $this->dependiente_empresa_ruc ?: null,
                'dependiente_empresa_rubro' => $this->dependiente_empresa_rubro ?: null,
                'dependiente_empresa_jefe' => $this->dependiente_empresa_jefe ?: null,
                'dependiente_cargo' => $this->dependiente_cargo ?: null,
                'dependiente_fecha_ingreso' => $this->dependiente_fecha_ingreso ?: null,
                'dependiente_condicion_cargo' => $this->dependiente_condicion_cargo ?: null,
                'condicion_formalidad' => $this->condicion_formalidad ?: null,

                'calificacion_formacion' => $this->calificacion_formacion ?: null,
                'utilidad_contenido' => $this->utilidad_contenido ?: null,
                'satisfaccion_formacion' => $this->satisfaccion_formacion ?: null,

                'medio_contacto_preferido' => $this->medio_contacto_preferido ?: null,
                'disponibilidad_dias' => $this->disponibilidad_dias ?: null,
                'disponibilidad_horarios' => !empty($horarios) ? $horarios : null,

                'otra_actividad_descripcion' => $this->sin_otra_actividad ? null : ($this->otra_actividad_descripcion ?: null),
                'sin_otra_actividad' => $this->sin_otra_actividad,

                'estudia_otra_carrera' => $this->estudia_otra_carrera,
                'otra_carrera_nombre' => $this->otra_carrera_nombre ?: null,
                'otra_carrera_institucion' => $this->otra_carrera_institucion ?: null,
                'otra_carrera_tipo_institucion' => $this->otra_carrera_tipo_institucion ?: null,

                'sugerencias' => $this->sugerencias ?: null,
                'fecha_completado' => now(),

            ]);

            // 5. Incrementa el contador de usos del enlace
            $this->link->increment('usos_actuales');
        });

        // Flash + redirección
        // Añade un mensaje flash a la sesión antes de redirigir
        session()->flash('survey_completed', '¡Gracias por completar la encuesta!');
        return $this->redirect(route('encuesta.gracias'), navigate: true);
    }

    public function render()
    {
        return view('livewire.survey.survey-form');
    }
}
