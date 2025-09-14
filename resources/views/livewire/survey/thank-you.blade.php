<x-layouts.guest title="Encuesta Completada">

    <div class="flex items-center justify-center min-h-screen bg-slate-100 dark:bg-slate-900 px-4 py-8">

        @if (session('survey_completed'))
            <div class="max-w-md w-full text-center bg-white dark:bg-slate-800 shadow-2xl rounded-xl p-8 md:p-12 transform transition-all duration-500 ease-in-out scale-100">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 dark:bg-green-900/50 mb-6">
                    <svg class="h-12 w-12 text-green-500 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                    ¡Encuesta Enviada!
                </h1>

                <p class="mt-4 text-base text-slate-600 dark:text-slate-400">
                    Muchas gracias por tu tiempo y colaboración. Tu reporte nos ayuda a mejorar el servicio educativo y a fortalecer nuestra comunidad de egresados.
                </p>

                <div class="mt-8 border-t border-slate-200 dark:border-slate-700 pt-6">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Si tienes alguna consulta adicional o deseas contactar con el área de Bienestar y Empleabilidad, no dudes en escribirnos.
                    </p>
                    <a href="mailto:bienestar@iestpfelipehuaman.edu.pe" class="mt-2 inline-block font-semibold text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        bienestar@iestpfelipehuaman.edu.pe 
                    </a>
                </div>

                <div class="mt-8">
                    <a href="/" class="px-6 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Volver a la página principal
                    </a>
                </div>
            </div>

        @else
            <div class="max-w-md w-full text-center">
                <h1 class="text-2xl font-bold text-slate-700 dark:text-slate-300">Acceso no permitido</h1>
                <p class="mt-2 text-slate-500 dark:text-slate-400">
                    Esta página solo está disponible después de completar una encuesta.
                </p>
                 <div class="mt-6">
                    <a href="/" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        Ir a la página principal &rarr;
                    </a>
                </div>
            </div>
        @endif

    </div>

</x-layouts.guest>