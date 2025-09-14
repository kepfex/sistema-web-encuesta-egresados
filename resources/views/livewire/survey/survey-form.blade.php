@php
    $formLabelClass = 'block mb-2 text-sm font-medium text-gray-900 dark:text-white';
    $formInputClass =
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
    $formRadioClass = 'h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500';
    $formRadioLabelClass = 'ml-2 block text-sm text-slate-900 dark:text-slate-300';
@endphp

<div class="bg-slate-100 dark:bg-slate-900 min-h-screen antialiased">
    <div class="container mx-auto px-4 py-8 sm:py-16">

        <div class="max-w-3xl mx-auto text-center mb-12">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                Formulario de Seguimiento a Egresados
            </h1>
            <p class="mt-4 text-sm text-slate-600 dark:text-slate-400 text-left">
                Estimado egresado:
            </p>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 text-justify">
                La presente encuesta sirve de información para mejorar los servicios que brinda la institución, del
                mismo modo nos sirve de contacto a fin de brindarle información de los beneficios que tendría, así
                como las relaciones egresados-institución los cuales fortalecerá el desarrollo institucional, por lo que
                sírvase responder las siguientes interrogantes:
            </p>
        </div>

        <div
            class="max-w-5xl mx-auto bg-white dark:bg-slate-800 shadow-2xl rounded-xl overflow-hidden lg:grid lg:grid-cols-3">

            <aside class="hidden lg:block lg:col-span-1 border-r border-slate-200 dark:border-slate-700 p-8">
                <nav aria-label="Steps">
                    <ol role="list" class="space-y-6">
                        @php
                            $steps = [
                                1 => 'Identificación',
                                2 => 'Residencia',
                                3 => 'Datos Personales',
                                4 => 'Actividad Laboral',
                                5 => 'Formación Profesional',
                                6 => 'Medios de Contacto',
                                7 => 'Otras Actividades',
                                8 => 'Sugerencias',
                            ];
                        @endphp


                        @foreach ($steps as $step => $title)
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    @if ($step < $currentStep)
                                        <div
                                            class="h-10 w-10 flex items-center justify-center bg-emerald-500 rounded-full">
                                            <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                            </svg>
                                        </div>
                                    @elseif ($step === $currentStep)
                                        <div
                                            class="relative h-10 w-10 flex items-center justify-center bg-blue-600 rounded-full">
                                            <span class="absolute h-4 w-4 top-0 right-0 -mt-1 -mr-1 flex">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-3 w-3 bg-blue-500 top-0.5 right-0.5"></span>
                                            </span>
                                            <span class="text-white font-bold">{{ $step }}</span>
                                        </div>
                                    @else
                                        <div
                                            class="h-10 w-10 flex items-center justify-center border-2 border-slate-300 dark:border-slate-600 rounded-full">
                                            <span class="text-slate-500 dark:text-slate-400">{{ $step }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h3
                                        class="text-sm font-semibold 
                                    @if ($step === $currentStep) text-blue-600 dark:text-blue-400 
                                    @else text-slate-900 dark:text-slate-200 @endif">
                                        Paso {{ $step }}
                                    </h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $title }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </aside>

            <main class="lg:col-span-2">
                <form wire:submit="submit">
                    <div class="px-4 py-6 sm:p-8">

                        <div class="{{ $currentStep === 1 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">
                                Sección 1: Identificación del Egresado
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Completa tus datos de contacto y académicos.
                            </p>

                            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                                <!-- Correo -->
                                <div class="sm:col-span-2">
                                    <label for="correo_electronico" class="{{ $formLabelClass }}">Correo
                                        electrónico</label>
                                    <input type="email" wire:model.lazy="correo_electronico" id="correo_electronico"
                                        placeholder="Ej: correo@gmail.com" class="{{ $formInputClass }}">
                                    @error('correo_electronico')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nombre completo -->
                                <div class="sm:col-span-2">
                                    <label for="nombre_completo" class="{{ $formLabelClass }}">Apellidos y
                                        Nombres</label>
                                    <input type="text" wire:model.lazy="nombre_completo" id="nombre_completo"
                                        placeholder="Ingresa tus Apellidos y Nombres completos"
                                        class="{{ $formInputClass }}">
                                    @error('nombre_completo')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- DNI -->
                                <div>
                                    <label for="dni" class="{{ $formLabelClass }}">DNI</label>
                                    <input type="text" wire:model.lazy="dni" id="dni" maxlength="8"
                                        placeholder="Ej: 22345678" class="{{ $formInputClass }}">
                                    @error('dni')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Celular -->
                                <div>
                                    <label for="numero_celular" class="{{ $formLabelClass }}">Número de celular</label>
                                    <input type="tel" wire:model.lazy="numero_celular" id="numero_celular"
                                        placeholder="Ej: 93765675" class="{{ $formInputClass }}">
                                    @error('numero_celular')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Programa -->
                                <div>
                                    <label for="programa_id" class="{{ $formLabelClass }}">Programa de estudios</label>
                                    <select wire:model.lazy="programa_id" id="programa_id"
                                        class="{{ $formInputClass }}">
                                        <option value="">Seleccione...</option>
                                        @foreach ($programas as $programa)
                                            <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('programa_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Año egreso -->
                                <div>
                                    <label for="anio_egreso" class="{{ $formLabelClass }}">
                                        Año de culminación (VI semestre)
                                    </label>
                                    <input type="number" wire:model.lazy="anio_egreso" id="anio_egreso"
                                        placeholder="Ej: 2024" class="{{ $formInputClass }}">
                                    @error('anio_egreso')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Fecha de titulación -->
                                <div>
                                    <label for="fecha_titulacion" class="{{ $formLabelClass }}">Fecha de
                                        Titulación</label>
                                    <input type="date" wire:model.lazy="fecha_titulacion" id="fecha_titulacion"
                                        class="{{ $formInputClass }}">
                                    @error('fecha_titulacion')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="{{ $currentStep === 2 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">Sección 2:
                                Dirección de Residencia</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Indícanos dónde resides actualmente.
                            </p>
                            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">

                                <div class="sm:col-span-2">
                                    <label for="direccion_residencia" class="{{ $formLabelClass }}">Dirección donde
                                        vive permanentemente</label>
                                    <input type="text" wire:model.lazy="direccion_residencia"
                                        id="direccion_residencia" class="{{ $formInputClass }}"
                                        placeholder="Ej: Av. El Sol 123">
                                    @error('direccion_residencia')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="residencia_departamento_id"
                                        class="{{ $formLabelClass }}">Departamento</label>
                                    <select wire:model.live="residencia_departamento_id"
                                        id="residencia_departamento_id" class="{{ $formInputClass }}">
                                        <option value="">Seleccione un Departamento...</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->idDepartamento }}">
                                                {{ $departamento->departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="residencia_provincia_id"
                                        class="{{ $formLabelClass }}">Provincia</label>
                                    <div class="relative">
                                        <select wire:model.live="residencia_provincia_id" id="residencia_provincia_id"
                                            class="{{ $formInputClass }}"
                                            @if (count($provinciasResidencia) == 0) disabled @endif>
                                            <option value="">Seleccione una Provincia...</option>
                                            @foreach ($provinciasResidencia as $provincia)
                                                <option value="{{ $provincia->idProvincia }}">
                                                    {{ $provincia->provincia }}</option>
                                            @endforeach
                                        </select>
                                        <div wire:loading wire:target="residencia_departamento_id"
                                            class="absolute inset-0 bg-white dark:bg-slate-700 bg-opacity-75 flex items-center justify-center">
                                            <span class="text-sm text-slate-500 dark:text-slate-300">Cargando
                                                provincias...</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="residencia_distrito_id"
                                        class="{{ $formLabelClass }}">Distrito</label>
                                    <div class="relative">
                                        <select wire:model.lazy="residencia_distrito_id" id="residencia_distrito_id"
                                            class="{{ $formInputClass }}"
                                            @if (count($distritosResidencia) == 0) disabled @endif>
                                            <option value="">Seleccione un Distrito...</option>
                                            @foreach ($distritosResidencia as $distrito)
                                                <option value="{{ $distrito->idDistrito }}">{{ $distrito->distrito }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div wire:loading wire:target="residencia_provincia_id"
                                            class="absolute inset-0 bg-white dark:bg-slate-700 bg-opacity-75 flex items-center justify-center">
                                            <span class="text-sm text-slate-500 dark:text-slate-300">Cargando
                                                distritos...</span>
                                        </div>
                                    </div>
                                    @error('residencia_distrito_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="{{ $currentStep === 3 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">Sección 3: Datos
                                Personales</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Información básica sobre ti.</p>

                            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">

                                <div>
                                    <label for="edad" class="{{ $formLabelClass }}">Edad</label>
                                    <input type="number" wire:model.lazy="edad" id="edad"
                                        class="{{ $formInputClass }}">
                                    @error('edad')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sexo" class="{{ $formLabelClass }}">Sexo</label>
                                    <select wire:model.lazy="sexo" id="sexo" class="{{ $formInputClass }}">
                                        <option value="">Seleccione...</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                    @error('sexo')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="fecha_nacimiento" class="{{ $formLabelClass }}">Fecha de
                                        nacimiento</label>
                                    <input type="date" wire:model.lazy="fecha_nacimiento" id="fecha_nacimiento"
                                        class="{{ $formInputClass }}">
                                    @error('fecha_nacimiento')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <p class="{{ $formLabelClass }} mb-2">Lugar de nacimiento</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-6">
                                        <div>
                                            <label for="nacimiento_departamento_id" class="sr-only">Departamento de
                                                Nacimiento</label>
                                            <select wire:model.live="nacimiento_departamento_id"
                                                id="nacimiento_departamento_id" class="{{ $formInputClass }}">
                                                <option value="">Departamento...</option>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->idDepartamento }}">
                                                        {{ $departamento->departamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label for="nacimiento_provincia_id" class="sr-only">Provincia de
                                                Nacimiento</label>
                                            <div class="relative">
                                                <select wire:model.live="nacimiento_provincia_id"
                                                    id="nacimiento_provincia_id" class="{{ $formInputClass }}"
                                                    @if (count($provinciasNacimiento) == 0) disabled @endif>
                                                    <option value="">Provincia...</option>
                                                    @foreach ($provinciasNacimiento as $provincia)
                                                        <option value="{{ $provincia->idProvincia }}">
                                                            {{ $provincia->provincia }}</option>
                                                    @endforeach
                                                </select>
                                                <div wire:loading wire:target="nacimiento_departamento_id"
                                                    class="absolute inset-0 bg-white dark:bg-slate-700 bg-opacity-75 flex items-center justify-center rounded-md">
                                                    <span
                                                        class="text-xs text-slate-500 dark:text-slate-300">Cargando...</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="nacimiento_distrito_id" class="sr-only">Distrito de
                                                Nacimiento</label>
                                            <div class="relative">
                                                <select wire:model.lazy="nacimiento_distrito_id"
                                                    id="nacimiento_distrito_id" class="{{ $formInputClass }}"
                                                    @if (count($distritosNacimiento) == 0) disabled @endif>
                                                    <option value="">Distrito...</option>
                                                    @foreach ($distritosNacimiento as $distrito)
                                                        <option value="{{ $distrito->idDistrito }}">
                                                            {{ $distrito->distrito }}</option>
                                                    @endforeach
                                                </select>
                                                <div wire:loading wire:target="nacimiento_provincia_id"
                                                    class="absolute inset-0 bg-white dark:bg-slate-700 bg-opacity-75 flex items-center justify-center rounded-md">
                                                    <span
                                                        class="text-xs text-slate-500 dark:text-slate-300">Cargando...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('nacimiento_distrito_id')
                                        <p class="mt-1 text-sm text-red-500">El campo de distrito de nacimiento es
                                            requerido.</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="{{ $currentStep === 4 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">
                                Sección 4: Actividad Laboral
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Cuéntanos sobre tu situación laboral actual.
                            </p>

                            <div class="mt-6 space-y-8">
                                {{-- 🔹 Inicio post egreso --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">
                                        ¿Luego de haber egresado, inició a desempeñarse en la especialidad que estudió?
                                    </legend>
                                    <div class="mt-3 flex space-x-6">
                                        <label class="flex items-center">
                                            <input wire:model.lazy="desempeno_post_egreso" type="radio"
                                                value="1" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Sí</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="desempeno_post_egreso" type="radio"
                                                value="0" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">No</span>
                                        </label>
                                    </div>
                                    @error('desempeno_post_egreso')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- 🔹 Inicio post titulación --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">
                                        ¿Luego de titularse, inició a desempeñarse en la especialidad que estudió?
                                    </legend>
                                    <div class="mt-3 flex space-x-6">
                                        <label class="flex items-center">
                                            <input wire:model.lazy="desempeno_post_titulacion" type="radio"
                                                value="1" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Sí</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="desempeno_post_titulacion" type="radio"
                                                value="0" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">No</span>
                                        </label>
                                    </div>
                                    @error('desempeno_post_titulacion')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- 🔹 Tiempos sin trabajar --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label for="tiempo_sin_trabajar_egreso" class="{{ $formLabelClass }}">
                                            Tiempo sin trabajar tras egresar
                                        </label>
                                        <input type="text" id="tiempo_sin_trabajar_egreso"
                                            wire:model.lazy="tiempo_sin_trabajar_egreso" placeholder="Ej: 6 meses"
                                            class="{{ $formInputClass }}">
                                        @error('tiempo_sin_trabajar_egreso')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="tiempo_sin_trabajar_titulacion" class="{{ $formLabelClass }}">
                                            Tiempo sin trabajar tras titularse
                                        </label>
                                        <input type="text" id="tiempo_sin_trabajar_titulacion"
                                            wire:model.lazy="tiempo_sin_trabajar_titulacion" placeholder="Ej: 3 meses"
                                            class="{{ $formInputClass }}">
                                        @error('tiempo_sin_trabajar_titulacion')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 🔹 Condición laboral --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">Actualmente, ¿cuál es su condición laboral?
                                    </legend>
                                    <div class="mt-3 flex flex-col sm:flex-row sm:space-x-6 space-y-2 sm:space-y-0">
                                        <label class="flex items-center">
                                            <input wire:model.live="condicion_laboral" type="radio"
                                                value="laborando" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Sí, laborando</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.live="condicion_laboral" type="radio"
                                                value="no laborando" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">No, no laborando</span>
                                        </label>
                                    </div>
                                    @error('condicion_laboral')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- 🔹 Si no labora --}}
                                @if ($condicion_laboral === 'no laborando')
                                    <div
                                        class="p-5 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-200 dark:border-slate-700">
                                        <label for="motivo_no_ejerce_carrera" class="{{ $formLabelClass }}">
                                            ¿Por qué no se encuentra ejerciendo la carrera?
                                        </label>
                                        <textarea wire:model.lazy="motivo_no_ejerce_carrera" id="motivo_no_ejerce_carrera" rows="3"
                                            class="{{ $formInputClass }}"></textarea>
                                        @error('motivo_no_ejerce_carrera')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif

                                {{-- 🔹 Si labora --}}
                                @if ($condicion_laboral === 'laborando')
                                    <div class="p-5 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-200 dark:border-slate-700 space-y-8">
                                        <label for="remuneracion_mensual" class="{{ $formLabelClass }}">Remuneración
                                            mensual
                                            (S/.)</label>
                                        <input type="number" id="remuneracion_mensual"
                                            wire:model.lazy="remuneracion_mensual" class="mb-2 {{ $formInputClass }}">
                                        @error('remuneracion_mensual')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div
                                        class="p-5 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-200 dark:border-slate-700 space-y-8">
                                        {{-- Estado actual --}}
                                        <fieldset>
                                            <legend class="{{ $formLabelClass }}">Estado actual del trabajo</legend>
                                            <div class="mt-3 flex flex-col space-y-3">
                                                <label class="flex items-start">
                                                    <input wire:model.live="es_independiente" type="checkbox"
                                                        class="mt-0.5 {{ $formRadioClass }}">
                                                    <span class="{{ $formRadioLabelClass }}">Independiente (tengo
                                                        negocio propio u otro oficio personal)</span>
                                                </label>
                                                @if ($es_independiente)
                                                    <div class="pl-7">
                                                        <input type="text"
                                                            wire:model.lazy="independiente_descripcion"
                                                            placeholder="¿Cuál?" class="{{ $formInputClass }}">
                                                        @error('independiente_descripcion')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                @endif

                                                <label class="flex items-start">
                                                    <input wire:model.live="es_dependiente" type="checkbox"
                                                        class="mt-0.5 {{ $formRadioClass }}">
                                                    <span class="{{ $formRadioLabelClass }}">Dependiente
                                                        (laboro en una institución del estado o empresa)</span>
                                                </label>

                                                <label
                                                    class="flex items-start pt-2 border-t border-slate-200 dark:border-slate-600">
                                                    <input wire:model.live="no_aplica_empleo" type="checkbox"
                                                        class="mt-0.5 {{ $formRadioClass }}">
                                                    <span class="{{ $formRadioLabelClass }}">No aplica</span>
                                                </label>
                                            </div>
                                            @error('tipo_empleo_general')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </fieldset>

                                        {{-- Datos Dependiente --}}
                                        @if ($es_dependiente)
                                            <div
                                                class="space-y-6 pt-6 border-t border-slate-200 dark:border-slate-600">
                                                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                                                    <div class="sm:col-span-2">
                                                        <label for="dependiente_empresa_nombre"
                                                            class="{{ $formLabelClass }}">Nombre de la institución o
                                                            empresa o negocio donde labora</label>
                                                        <input type="text" id="dependiente_empresa_nombre"
                                                            wire:model.lazy="dependiente_empresa_nombre"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_empresa_nombre')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="sm:col-span-2">
                                                        <label for="dependiente_empresa_direccion"
                                                            class="{{ $formLabelClass }}">Dirección</label>
                                                        <input type="text" id="dependiente_empresa_direccion"
                                                            wire:model.lazy="dependiente_empresa_direccion"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_empresa_direccion')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    {{-- Ubicación --}}
                                                    <div>
                                                        <label for="dependiente_empresa_departamento_id"
                                                            class="{{ $formLabelClass }}">Región</label>
                                                        <select wire:model.live="dependiente_empresa_departamento_id"
                                                            id="dependiente_empresa_departamento_id"
                                                            class="{{ $formInputClass }}">
                                                            <option value="">Seleccione...</option>
                                                            @foreach ($departamentos as $departamento)
                                                                <option value="{{ $departamento->idDepartamento }}">
                                                                    {{ $departamento->departamento }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('dependiente_empresa_departamento_id')
                                                            <p class="mt-1 text-sm text-red-500">Este campo es requerido.
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_empresa_provincia_id"
                                                            class="{{ $formLabelClass }}">Provincia</label>
                                                        <div class="relative">
                                                            <select wire:model.live="dependiente_empresa_provincia_id"
                                                                id="dependiente_empresa_provincia_id"
                                                                class="{{ $formInputClass }}"
                                                                @if (count($provinciasEmpresa) == 0) disabled @endif>>
                                                                <option value="">Seleccione...</option>
                                                                @foreach ($provinciasEmpresa as $provincia)
                                                                    <option value="{{ $provincia->idProvincia }}">
                                                                        {{ $provincia->provincia }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div wire:loading
                                                                wire:target="dependiente_empresa_departamento_id"
                                                                class="absolute inset-0 bg-white dark:bg-slate-700 bg-opacity-75 flex items-center justify-center rounded-md">
                                                                <span
                                                                    class="text-xs text-slate-500 dark:text-slate-300">Cargando...</span>
                                                            </div>
                                                        </div>
                                                        @error('dependiente_empresa_provincia_id')
                                                            <p class="mt-1 text-sm text-red-500">Este campo es requerido.
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_empresa_distrito_id"
                                                            class="{{ $formLabelClass }}">Distrito</label>
                                                        <div class="relative">
                                                            <select wire:model.lazy="dependiente_empresa_distrito_id"
                                                                id="dependiente_empresa_distrito_id"
                                                                class="{{ $formInputClass }}"
                                                                @if (count($distritosEmpresa) == 0) disabled @endif>>
                                                                <option value="">Seleccione...</option>
                                                                @foreach ($distritosEmpresa as $distrito)
                                                                    <option value="{{ $distrito->idDistrito }}">
                                                                        {{ $distrito->distrito }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div wire:loading
                                                                wire:target="dependiente_empresa_provincia_id"
                                                                class="absolute inset-0 bg-white dark:bg-slate-700 bg-opacity-75 flex items-center justify-center rounded-md">
                                                                <span
                                                                    class="text-xs text-slate-500 dark:text-slate-300">Cargando...</span>
                                                            </div>
                                                        </div>
                                                        @error('dependiente_empresa_distrito_id')
                                                            <p class="mt-1 text-sm text-red-500">Este campo es requerido.
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    {{-- Otros datos --}}
                                                    <div>
                                                        <label for="dependiente_empresa_tipo"
                                                            class="{{ $formLabelClass }}">Tipo de empresa</label>
                                                        <input type="text" id="dependiente_empresa_tipo"
                                                            wire:model.lazy="dependiente_empresa_tipo"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_empresa_tipo')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_empresa_ruc"
                                                            class="{{ $formLabelClass }}">RUC</label>
                                                        <input type="text" id="dependiente_empresa_ruc"
                                                            wire:model.lazy="dependiente_empresa_ruc"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_empresa_ruc')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_empresa_rubro"
                                                            class="{{ $formLabelClass }}">Actividad / Rubro</label>
                                                        <input type="text" id="dependiente_empresa_rubro"
                                                            wire:model.lazy="dependiente_empresa_rubro"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_empresa_rubro')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_empresa_jefe"
                                                            class="{{ $formLabelClass }}">Nombre del jefe
                                                            inmediato</label>
                                                        <input type="text" id="dependiente_empresa_jefe"
                                                            wire:model.lazy="dependiente_empresa_jefe"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_empresa_jefe')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_cargo"
                                                            class="{{ $formLabelClass }}">Cargo que desempeña</label>
                                                        <input type="text" id="dependiente_cargo"
                                                            wire:model.lazy="dependiente_cargo"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_cargo')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label for="dependiente_fecha_ingreso"
                                                            class="{{ $formLabelClass }}">Fecha de ingreso</label>
                                                        <input type="date" id="dependiente_fecha_ingreso"
                                                            wire:model.lazy="dependiente_fecha_ingreso"
                                                            class="{{ $formInputClass }}">
                                                        @error('dependiente_fecha_ingreso')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>


                                                </div>

                                                {{-- Condición del cargo --}}
                                                <fieldset class="sm:col-span-2">
                                                    <legend class="{{ $formLabelClass }}">Condición del cargo
                                                    </legend>
                                                    <div class="mt-3 flex space-x-6">
                                                        <label class="flex items-center">
                                                            <input wire:model.lazy="dependiente_condicion_cargo"
                                                                type="radio" value="nombrado"
                                                                class="{{ $formRadioClass }}">
                                                            <span class="{{ $formRadioLabelClass }}">Nombrado</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <input wire:model.lazy="dependiente_condicion_cargo"
                                                                type="radio" value="contratado"
                                                                class="{{ $formRadioClass }}">
                                                            <span
                                                                class="{{ $formRadioLabelClass }}">Contratado</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <input wire:model.lazy="dependiente_condicion_cargo"
                                                                type="radio" value="temporal"
                                                                class="{{ $formRadioClass }}">
                                                            <span class="{{ $formRadioLabelClass }}">Temporal</span>
                                                        </label>
                                                    </div>
                                                    @error('dependiente_condicion_cargo')
                                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </fieldset>

                                                {{-- Formalidad --}}
                                                <fieldset class="sm:col-span-2">
                                                    <legend class="{{ $formLabelClass }}">Formalidad del empleo
                                                    </legend>
                                                    <div class="mt-3 flex space-x-6">
                                                        <label class="flex items-center">
                                                            <input wire:model.lazy="condicion_formalidad"
                                                                type="radio" value="formal"
                                                                class="{{ $formRadioClass }}">
                                                            <span class="{{ $formRadioLabelClass }}">Formal</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <input wire:model.lazy="condicion_formalidad"
                                                                type="radio" value="informal"
                                                                class="{{ $formRadioClass }}">
                                                            <span class="{{ $formRadioLabelClass }}">Informal</span>
                                                        </label>
                                                    </div>
                                                    @error('condicion_formalidad')
                                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $currentStep === 5 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">
                                Sección 5: Evaluación de la Formación Profesional
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Cuéntanos cómo percibes la formación recibida en la institución.
                            </p>

                            <div class="mt-6 space-y-8">
                                {{-- 🔹 Calificación de la formación --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">¿Cómo calificarías la formación recibida?
                                    </legend>
                                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <label class="flex items-center">
                                            <input wire:model.lazy="calificacion_formacion" type="radio"
                                                value="muy_apropiada" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Muy apropiada</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="calificacion_formacion" type="radio"
                                                value="apropiada" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Apropiada</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="calificacion_formacion" type="radio"
                                                value="regularmente_apropiada" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Regularmente apropiada</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="calificacion_formacion" type="radio"
                                                value="inapropiada" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Inapropiada</span>
                                        </label>
                                    </div>
                                    @error('calificacion_formacion')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- 🔹 Utilidad del contenido --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">¿El contenido aprendido fue útil?</legend>
                                    <div class="mt-3 flex flex-wrap gap-6">
                                        <label class="flex items-center">
                                            <input wire:model.lazy="utilidad_contenido" type="radio" value="si"
                                                class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Sí</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="utilidad_contenido" type="radio" value="no"
                                                class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">No</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="utilidad_contenido" type="radio"
                                                value="a medias" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">A medias</span>
                                        </label>
                                    </div>
                                    @error('utilidad_contenido')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- 🔹 Nivel de satisfacción --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">Nivel de satisfacción con la formación
                                        recibida</legend>
                                    <div class="mt-3 flex space-x-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <label class="flex items-center">
                                                <input wire:model.lazy="satisfaccion_formacion" type="radio"
                                                    value="{{ $i }}" class="{{ $formRadioClass }}">
                                                <span class="{{ $formRadioLabelClass }}">{{ $i }}</span>
                                            </label>
                                        @endfor
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                        1 = Nada satisfecho, 5 = Muy satisfecho
                                    </p>
                                    @error('satisfaccion_formacion')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>
                            </div>
                        </div>

                        <div class="{{ $currentStep === 6 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">
                                Sección 6: Medios de Contacto
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Indícanos cuál es tu medio de contacto preferido y tu disponibilidad.
                            </p>

                            <div class="mt-6 space-y-8">
                                {{-- Medio de contacto preferido --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">¿Por qué medio prefieres que te
                                        contactemos?</legend>
                                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <label class="flex items-center">
                                            <input wire:model.lazy="medio_contacto_preferido" type="radio"
                                                value="correo" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Correo electrónico</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="medio_contacto_preferido" type="radio"
                                                value="whatsapp" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">WhatsApp</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="medio_contacto_preferido" type="radio"
                                                value="facebook" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Facebook</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="medio_contacto_preferido" type="radio"
                                                value="llamada" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Llamada telefónica</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.lazy="medio_contacto_preferido" type="radio"
                                                value="otro" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Otro</span>
                                        </label>
                                    </div>
                                    @error('medio_contacto_preferido')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- Disponibilidad de días --}}
                                <div>
                                    <label for="disponibilidad_dias" class="{{ $formLabelClass }}">Días de
                                        disponibilidad</label>
                                    <input type="text" wire:model.lazy="disponibilidad_dias"
                                        id="disponibilidad_dias" placeholder="Ej: Lunes, Miércoles y Viernes"
                                        class="{{ $formInputClass }}">
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                        Puedes escribir uno o varios días separados por coma.
                                    </p>
                                    @error('disponibilidad_dias')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Disponibilidad de horarios --}}
                                <div>
                                    <label for="disponibilidad_horarios" class="{{ $formLabelClass }}">Horarios de
                                        disponibilidad</label>
                                    <textarea wire:model.lazy="disponibilidad_horarios" id="disponibilidad_horarios" rows="2"
                                        class="{{ $formInputClass }}" placeholder="Ej: Mañana 8-12, Tarde 2-6, Noche 7-9"></textarea>
                                    @error('disponibilidad_horarios')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="{{ $currentStep === 7 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">
                                Sección 7: Otras Actividades
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Infórmanos si realizas otras actividades académicas o laborales.
                            </p>

                            <div class="mt-6 space-y-8">
                                {{-- Otra actividad --}}
                                <div x-data="{ none: @entangle('sin_otra_actividad') }">
                                    <label for="otra_actividad_descripcion" class="{{ $formLabelClass }}">
                                        ¿A qué otra actividad te dedicas actualmente?
                                    </label>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <textarea wire:model.lazy="otra_actividad_descripcion" id="otra_actividad_descripcion" rows="2"
                                            class="{{ $formInputClass }} flex-grow" :disabled="none"></textarea>
                                        <div class="flex items-center whitespace-nowrap">
                                            <input x-model="none" id="sin_otra_actividad" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <label for="sin_otra_actividad" class="{{ $formRadioLabelClass }}">No
                                                tengo otra actividad</label>
                                        </div>
                                    </div>
                                    @error('otra_actividad_descripcion')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Estudia otra carrera --}}
                                <fieldset>
                                    <legend class="{{ $formLabelClass }}">¿Estudias otra carrera?</legend>
                                    <div class="mt-3 flex space-x-6">
                                        <label class="flex items-center">
                                            <input wire:model.live="estudia_otra_carrera" type="radio"
                                                value="1" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">Sí</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input wire:model.live="estudia_otra_carrera" type="radio"
                                                value="0" class="{{ $formRadioClass }}">
                                            <span class="{{ $formRadioLabelClass }}">No</span>
                                        </label>
                                    </div>
                                    @error('estudia_otra_carrera')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </fieldset>

                                {{-- Datos de otra carrera --}}
                                @if ($estudia_otra_carrera)
                                    <div
                                        class="p-5 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-200 dark:border-slate-700 space-y-6">
                                        <div>
                                            <label for="otra_carrera_nombre" class="{{ $formLabelClass }}">¿Qué
                                                carrera estudias o estudiaste?</label>
                                            <input type="text" wire:model.lazy="otra_carrera_nombre"
                                                id="otra_carrera_nombre" class="{{ $formInputClass }}">
                                            @error('otra_carrera_nombre')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="otra_carrera_institucion"
                                                class="{{ $formLabelClass }}">¿Nombre de la institución donde
                                                estudias o estudiaste?</label>
                                            <input type="text" wire:model.lazy="otra_carrera_institucion"
                                                id="otra_carrera_institucion" class="{{ $formInputClass }}">
                                        </div>
                                        <fieldset>
                                            <legend class="{{ $formLabelClass }}">La institución donde estudias o
                                                estudiaste es:
                                            </legend>
                                            <div
                                                class="mt-3 flex flex-col sm:flex-row sm:space-x-6 space-y-2 sm:space-y-0">
                                                <label class="flex items-center">
                                                    <input wire:model.lazy="otra_carrera_tipo_institucion"
                                                        type="radio" value="instituto_tecnologico"
                                                        class="{{ $formRadioClass }}">
                                                    <span class="{{ $formRadioLabelClass }}">Instituto
                                                        tecnológico</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input wire:model.lazy="otra_carrera_tipo_institucion"
                                                        type="radio" value="instituto_pedagogico"
                                                        class="{{ $formRadioClass }}">
                                                    <span class="{{ $formRadioLabelClass }}">Instituto
                                                        pedagógico</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input wire:model.lazy="otra_carrera_tipo_institucion"
                                                        type="radio" value="universidad"
                                                        class="{{ $formRadioClass }}">
                                                    <span class="{{ $formRadioLabelClass }}">Universidad</span>
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $currentStep === 8 ? '' : 'hidden' }}">
                            <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white">
                                Sección 8: Sugerencia o recomendación
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Sírvase brindar las sugerencias y/o recomendaciones que estime conveniente y que nos
                                permita mejorar el servicio educativo:
                            </p>

                            <div class="mt-6">
                                <label for="sugerencias" class="{{ $formLabelClass }}">
                                    Tus sugerencias o recomendaciones
                                </label>
                                <textarea wire:model.lazy="sugerencias" id="sugerencias" rows="6" class="{{ $formInputClass }} mt-2"
                                    placeholder="Tus sugerencias nos ayudarán mucho..."></textarea>
                                @error('sugerencias')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div
                                class="mt-8 space-y-4 p-5 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg">
                                <p class="text-sm text-slate-700 dark:text-slate-300">
                                    El <span class="font-semibold">Ministerio de Educación</span> le enviará una
                                    encuesta para completarla a través del sistema <span
                                        class="font-semibold">CONECTA</span>.
                                    Tu reporte nos ayuda a mejorar el servicio educativo.
                                </p>

                                <div class="mt-4 text-sm text-slate-600 dark:text-slate-400">
                                    <p><span class="font-semibold">Fecha de la encuesta:</span></p>
                                    <p>{{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }}</p>
                                </div>

                                <p class="mt-4 text-sm text-slate-700 dark:text-slate-300 font-semibold">
                                    Jefe de Bienestar y Empleabilidad
                                </p>
                            </div>

                            <div class="mt-8 text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <p class="text-sm text-blue-800 dark:text-blue-300">
                                    <span class="block">¡Estás a un solo paso de terminar!</span>
                                    Revisa tus respuestas si lo deseas y haz clic en <span
                                        class="font-semibold">"Finalizar y Enviar"</span> cuando estés listo.
                                </p>
                            </div>
                            @error('recaptcha_token')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 px-4 py-4 sm:px-8 flex justify-between items-center border-t border-slate-200 dark:border-slate-700">
                        <button type="button" wire:click="previousStep"
                            class="cursor-pointer px-5 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-600 dark:text-slate-200 border border-slate-300 dark:border-slate-500 rounded-md shadow-sm hover:bg-slate-50 dark:hover:bg-slate-500 disabled:opacity-50 disabled:cursor-not-allowed {{ $currentStep > 1 ? '' : 'invisible' }}">
                            Anterior
                        </button>

                        @if ($currentStep < $totalSteps)
                            <button type="button" wire:click="nextStep" wire:loading.attr="disabled"
                                class="cursor-pointer inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                                Siguiente
                                <svg wire:loading.remove wire:target="nextStep" class="ml-2 -mr-1 w-5 h-5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg wire:loading wire:target="nextStep"
                                    class="animate-spin ml-2 -mr-1 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        @endif

                        @if ($currentStep === $totalSteps)
                            <button type="button"
                                onclick="executeRecaptchaAndSubmit()"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-md shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50">
                                <span>Finalizar y Enviar</span>
                                <svg wire:loading wire:target="submit"
                                    class="animate-spin ml-2 -mr-1 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        @endif
                        {{-- @if ($currentStep === $totalSteps)
                            <button type="button" wire:click="submit" wire:loading.attr="disabled"
                                class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-md shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50">
                                <span>Finalizar y Enviar</span>
                                <svg wire:loading wire:target="submit"
                                    class="animate-spin ml-2 -mr-1 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        @endif --}}
                    </div>
                </form>
            </main>
        </div>
    </div>

    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script>
            function executeRecaptchaAndSubmit() {
                grecaptcha.ready(function () {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'})
                        .then(function (token) {
                            // console.log("Token recibido:", token); // Debug

                            // Asigna token al componente Livewire
                            @this.set('recaptcha_token', token);

                            // Llama al método submit de tu componente
                            @this.call('submit');
                        });
                });
            }
        </script>

    @endpush
</div>
