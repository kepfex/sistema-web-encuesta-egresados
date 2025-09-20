<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200">
    <div class="relative min-h-screen flex flex-col">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5 flex items-center space-x-3">
                        <span class="h-10 w-10">
                            <x-app-logo-icon />
                        </span>
                        <span
                            class="font-semibold whitespace-nowrap hidden sm:block">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <div class="flex lg:flex-1 lg:justify-end">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-4 py-2 text-sm font-semibold text-slate-900 dark:text-white shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="flex items-center gap-2 rounded-md px-4 py-2 text-sm font-semibold leading-6 text-slate-900 dark:text-white hover:text-slate-700 dark:hover:text-slate-300">
                                Iniciar Sesión
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                    <path d="M3 12h13l-3 -3" />
                                    <path d="M13 15l3 -3" />
                                </svg>
                            </a>
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <main class="relative isolate px-6 pt-14 lg:px-8 flex-grow flex items-center">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#3b82f6] to-[#1d4ed8] opacity-30 dark:opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:py-32">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-6xl">
                        Servicio de Empleabilidad y Bienestar
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600 dark:text-slate-400">
                        Fortalecemos el vínculo entre nuestros egresados y el mercado laboral, ofreciendo oportunidades
                        y seguimiento para su desarrollo profesional continuo.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('login') }}"
                            class="rounded-md bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            Acceder al Sistema
                        </a>
                        <a href="#programas" class="flex items-center gap-2 text-sm font-semibold leading-6 text-slate-900 dark:text-white">
                            Nuestros Programas
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-big-down">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15 4v8h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-8a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <section id="programas" class="w-full bg-white dark:bg-slate-800/50 py-16 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-600 dark:text-blue-400">Formación de Calidad
                    </h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Programas de Estudio que Impulsan tu Futuro
                    </p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                        @php
                            $programas = [
                                [
                                    'nombre' => 'Arquitectura de Plataformas y Servicios de TI',
                                    'descripcion' =>
                                        'Diseña, implementa y gestiona infraestructuras tecnológicas robustas y seguras.',
                                ],
                                [
                                    'nombre' => 'Construcción Civil',
                                    'descripcion' =>
                                        'Participa en la planificación y ejecución de proyectos de edificación e infraestructura.',
                                ],
                                [
                                    'nombre' => 'Enfermería Técnica',
                                    'descripcion' =>
                                        'Proporciona cuidados de salud esenciales, asistiendo al equipo médico y atendiendo a pacientes.',
                                ],
                                [
                                    'nombre' => 'Asistencia Administrativa',
                                    'descripcion' =>
                                        'Gestiona procesos y recursos administrativos para asegurar la eficiencia organizacional.',
                                ],
                            ];
                        @endphp

                        @foreach ($programas as $programa)
                            <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-slate-900 dark:text-white">
                                    <div
                                        class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                    {{ $programa['nombre'] }}
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-slate-600 dark:text-slate-400">
                                    {{ $programa['descripcion'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </section>

        <footer class="w-full text-center p-6 text-sm text-slate-500 dark:text-slate-400">
            <p>{{ config('app.name', 'Laravel') }} &copy; {{ date('Y') }}. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>

</html>
