<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.graduates.index') }}" wire:navigate>Egresados
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $graduate->nombre_completo }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="my-6 flex items-center">
        <a href="{{ route('admin.graduates.index') }}" wire:navigate
            class="hidden sm:flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="mr-1 icon icon-tabler icons-tabler-outline icon-tabler-arrow-left text-red-500">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l14 0" />
                <path d="M5 12l6 6" />
                <path d="M5 12l6 -6" />
            </svg>
            Volver al listado
        </a>
    </div>

    <div class="mb-8 flex flex-wrap  items-center justify-between gap-4">
        <h1 class="text-3xl font-black dark:text-white">{{ $title }}</h1>
        <a href="{{ route('graduates.survey.pdf', $graduate->id) }}" target="_blank"
            class="flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow">
            Descargar
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="ml-2 icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                <path d="M17 18h2" />
                <path d="M20 15h-3v6" />
                <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
            </svg>
        </a>
    </div>

    @if ($survey)
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 pb-0 sm:pt-8 sm:px-8 flex items-center justify-between">
                <div>
                    <div class="mt-1 flex items-center gap-x-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Enviada el:
                            {{ $survey->fecha_completado->format('d/m/Y H:i A') }}</p>
                        <span
                            class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-sm sm:text-xl font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-900/20 dark:text-blue-400 dark:ring-blue-400/20">
                            {{ $survey->codigoEncuesta }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6 sm:p-8 space-y-10">

                @php
                    $dlClass = 'grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-4';
                    $dtClass = 'text-sm font-medium text-gray-500 dark:text-gray-400';
                    $ddClass = 'mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2';
                    $sectionTitleClass =
                        'text-xl font-bold text-blue-700 dark:text-blue-400 border-b border-gray-200 dark:border-gray-700 pb-2 mb-6';
                @endphp

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 1 y 2: Identificación y Residencia</h3>
                    <dl class="{{ $dlClass }}">
                        <div>
                            <dt class="{{ $dtClass }}">Nombre Completo</dt>
                            <dd class="{{ $ddClass }} uppercase">{{ $graduate->nombre_completo }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">DNI</dt>
                            <dd class="{{ $ddClass }}">{{ $graduate->dni }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Correo</dt>
                            <dd class="{{ $ddClass }}">{{ $graduate->correo_electronico }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Celular</dt>
                            <dd class="{{ $ddClass }}">{{ $graduate->numero_celular }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Programa de Estudio</dt>
                            <dd class="{{ $ddClass }}">{{ $graduate->programa->nombre ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Año de Egreso</dt>
                            <dd class="{{ $ddClass }}">{{ $graduate->anio_egreso }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Fecha de Titulación</dt>
                            <dd class="{{ $ddClass }}">
                                {{ $graduate->fecha_titulacion?->format('d/m/Y') ?? 'No especificado' }}</dd>
                        </div>
                        <div class="sm:col-span-3">
                            <dt class="{{ $dtClass }}">Dirección</dt>
                            <dd class="{{ $ddClass }}">{{ $graduate->direccion_residencia }} <br> <span
                                    class="text-gray-500">{{ $graduate->distritoResidencia?->distrito . ' / ' . $graduate->distritoResidencia?->provincia?->provincia . ' / ' . $graduate->distritoResidencia?->provincia?->departamento?->departamento }}</span>
                            </dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 3: Datos Personales</h3>
                    <dl class="{{ $dlClass }}">
                        <div>
                            <dt class="{{ $dtClass }}">Edad</dt>
                            <dd class="{{ $ddClass }}">{{ $survey->edad }} años</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Sexo</dt>
                            <dd class="{{ $ddClass }}">{{ $survey->sexo }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Fecha de Nacimiento</dt>
                            <dd class="{{ $ddClass }}">{{ $survey->fecha_nacimiento?->format('d/m/Y') }}</dd>
                        </div>
                        <div class="sm:col-span-3">
                            <dt class="{{ $dtClass }}">Lugar de Nacimiento</dt>
                            <dd class="{{ $ddClass }}">
                                {{ $survey->distritoNacimiento?->distrito . ' / ' . $survey->distritoNacimiento?->provincia?->provincia . ' / ' . $survey->distritoNacimiento?->provincia?->departamento?->departamento }}
                            </dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 4: Actividad Laboral</h3>
                    <dl class="{{ $dlClass }}">
                        <div>
                            <dt class="{{ $dtClass }}">¿Se desempeñó en su área tras egresar?</dt>
                            <dd class="{{ $ddClass }} uppercase">
                                {{ $survey->desempeno_post_egreso ? 'Sí' : 'No' }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Tiempo sin trabajar tras egresar</dt>
                            <dd class="{{ $ddClass }} uppercase">{{ $survey->tiempo_sin_trabajar_egreso }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">¿Se desempeñó en su área tras titularse?</dt>
                            <dd class="{{ $ddClass }}  uppercase">
                                {{ $survey->desempeno_post_titulacion ? 'Sí' : 'No' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Tiempo sin trabajar tras titularse</dt>
                            <dd class="{{ $ddClass }}  uppercase">{{ $survey->tiempo_sin_trabajar_titulacion }}
                            </dd>
                        </div>
                        <div class="sm:col-span-3">
                            <hr class="dark:border-gray-700 my-2">
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Condición Laboral Actual</dt>
                            <dd class="{{ $ddClass }} font-semibold uppercase">{{ $survey->condicion_laboral }}
                            </dd>
                        </div>

                        @if ($survey->no_aplica_empleo)
                            {{-- Caso: No aplica empleo --}}
                            <div class="sm:col-span-3">
                                <dt class="{{ $dtClass }}">Situación</dt>
                                <dd class="{{ $ddClass }}">El egresado marcó <span
                                        class="font-semibold  uppercase">No
                                        aplica</span> para actividad laboral.</dd>
                            </div>
                        @elseif ($survey->condicion_laboral == 'laborando')
                            {{-- Caso: Laborando --}}
                            <div>
                                <dt class="{{ $dtClass }}">Remuneración Mensual</dt>
                                <dd class="{{ $ddClass }}">S/
                                    {{ number_format($survey->remuneracion_mensual, 2, '.', ',') }}</dd>
                            </div>
                            <div class="sm:col-span-3">
                                <hr class="dark:border-gray-700 my-2">
                            </div>

                            @if ($survey->es_independiente)
                                <div class="sm:col-span-3">
                                    <dt class="{{ $dtClass }}">Actividad Independiente</dt>
                                    <dd class="{{ $ddClass }}  uppercase">
                                        {{ $survey->independiente_descripcion }}</dd>
                                </div>
                            @endif

                            @if ($survey->es_dependiente)
                                <div class="sm:col-span-3">
                                    <dt class="{{ $dtClass }}">Actividad Dependiente</dt>
                                    <dd
                                        class="sm:col-span-3 mt-2 space-y-4 rounded-md border border-gray-200 dark:border-gray-700 p-4">
                                        <dl class="{{ $dlClass }}">
                                            <div>
                                                <dt class="{{ $dtClass }}">Empresa</dt>
                                                <dd class="{{ $ddClass }}  uppercase">
                                                    {{ $survey->dependiente_empresa_nombre }}</dd>
                                            </div>
                                            <div>
                                                <dt class="{{ $dtClass }}">RUC</dt>
                                                <dd class="{{ $ddClass }}">
                                                    {{ $survey->dependiente_empresa_ruc ?? 'N/A' }}</dd>
                                            </div>
                                            <div>
                                                <dt class="{{ $dtClass }}">Cargo</dt>
                                                <dd class="{{ $ddClass }}  uppercase">
                                                    {{ $survey->dependiente_cargo }}</dd>
                                            </div>
                                            <div>
                                                <dt class="{{ $dtClass }}">Fecha Ingreso</dt>
                                                <dd class="{{ $ddClass }}">
                                                    {{ $survey->dependiente_fecha_ingreso?->format('d/m/Y') }}</dd>
                                            </div>
                                            <div>
                                                <dt class="{{ $dtClass }}">Condición Cargo</dt>
                                                <dd class="{{ $ddClass }} uppercase">
                                                    {{ $survey->dependiente_condicion_cargo }}</dd>
                                            </div>
                                            <div>
                                                <dt class="{{ $dtClass }}">Formalidad</dt>
                                                <dd class="{{ $ddClass }} uppercase">
                                                    {{ $survey->condicion_formalidad }}</dd>
                                            </div>
                                            <div class="sm:col-span-3">
                                                <dt class="{{ $dtClass }}">Ubicación Empresa</dt>
                                                <dd class="{{ $ddClass }}">
                                                    {{ $survey->dependiente_empresa_direccion }} <br>
                                                    <span class="text-gray-500">
                                                        {{ $survey->dependienteEmpresaDistrito?->distrito }} /
                                                        {{ $survey->dependienteEmpresaDistrito?->provincia?->provincia }}
                                                        /
                                                        {{ $survey->dependienteEmpresaDistrito?->provincia?->departamento?->departamento }}
                                                    </span>
                                                </dd>
                                            </div>
                                        </dl>
                                    </dd>
                                </div>
                            @endif
                        @else
                            {{-- Caso: No laborando --}}
                            <div class="sm:col-span-3">
                                <dt class="{{ $dtClass }}">Motivo por el que no ejerce</dt>
                                <dd class="{{ $ddClass }}  uppercase">
                                    {{ $survey->motivo_no_ejerce_carrera ?? 'No especificado' }}</dd>
                            </div>
                        @endif
                    </dl>
                </section>

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 5: Evaluación de la formación</h3>
                    <dl class="{{ $dlClass }}">
                        <div>
                            <dt class="{{ $dtClass }}">Calificación de la formación</dt>
                            <dd class="{{ $ddClass }} capitalize">
                                {{ str_replace('_', ' ', $survey->calificacion_formacion) }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Utilidad del contenido</dt>
                            <dd class="{{ $ddClass }}">{{ ucfirst($survey->utilidad_contenido) }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Nivel de satisfacción</dt>
                            <dd class="{{ $ddClass }}">{{ $survey->satisfaccion_formacion }}/5</dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 6: Medios de contacto</h3>
                    <dl class="{{ $dlClass }}">
                        <div>
                            <dt class="{{ $dtClass }}">Medio preferido</dt>
                            <dd class="{{ $ddClass }} uppercase">
                                {{ ucfirst($survey->medio_contacto_preferido ?? 'No especificado') }}</dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Disponibilidad (días)</dt>
                            <dd class="{{ $ddClass }} uppercase">
                                {{ $survey->disponibilidad_dias ?? 'No especificado' }}
                            </dd>
                        </div>
                        <div class="sm:col-span-3">
                            <dt class="{{ $dtClass }}">Disponibilidad (horarios)</dt>
                            <dd class="{{ $ddClass }} uppercase">
                                @if ($survey->disponibilidad_horarios)
                                    {{ implode(', ', $survey->disponibilidad_horarios) }}
                                @else
                                    No especificado
                                @endif
                            </dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 7: Otras actividades</h3>
                    <dl class="{{ $dlClass }}">
                        <div class="sm:col-span-3">
                            <dt class="{{ $dtClass }}">Actividad adicional</dt>
                            <dd class="{{ $ddClass }} uppercase">
                                @if ($survey->sin_otra_actividad)
                                    No realiza otra actividad
                                @else
                                    {{ $survey->otra_actividad_descripcion ?? 'No especificado' }}
                                @endif
                            </dd>
                        </div>

                        <div>
                            <dt class="{{ $dtClass }}">¿Estudia otra carrera?</dt>
                            <dd class="{{ $ddClass }}  uppercase">
                                {{ $survey->estudia_otra_carrera ? 'Sí' : 'No' }}</dd>
                        </div>

                        @if ($survey->estudia_otra_carrera)
                            <div>
                                <dt class="{{ $dtClass }}">Nombre de la carrera</dt>
                                <dd class="{{ $ddClass }}  uppercase">{{ $survey->otra_carrera_nombre }}</dd>
                            </div>
                            <div>
                                <dt class="{{ $dtClass }}">Institución</dt>
                                <dd class="{{ $ddClass }}  uppercase">{{ $survey->otra_carrera_institucion }}
                                </dd>
                            </div>
                            <div>
                                <dt class="{{ $dtClass }}">Tipo de institución</dt>
                                <dd class="{{ $ddClass }}  uppercase">
                                    {{ str_replace('_', ' ', $survey->otra_carrera_tipo_institucion) }}</dd>
                            </div>
                        @endif
                    </dl>
                </section>

                <section>
                    <h3 class="{{ $sectionTitleClass }}">Sección 8: Sugerencias</h3>
                    <dl class="{{ $dlClass }}">
                        <div class="sm:col-span-3">
                            <dt class="{{ $dtClass }}">Sugerencias o recomendaciones</dt>
                            <dd class="{{ $ddClass }}  uppercase">
                                {{ $survey->sugerencias ?? 'No registró sugerencias' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="{{ $dtClass }}">Fecha completado</dt>
                            <dd class="{{ $ddClass }}">
                                {{ $survey->fecha_completado->translatedFormat('d \d\e F \d\e Y, H:i A') }}</dd>
                        </div>
                    </dl>
                </section>

            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-12 text-center">
            <h3 class="text-xl font-medium text-gray-900 dark:text-white">Sin Encuesta</h3>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Este egresado aún no tiene ninguna encuesta registrada.
            </p>
        </div>
    @endif
</div>
