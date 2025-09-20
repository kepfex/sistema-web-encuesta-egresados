<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen font-sans antialiased bg-slate-100 dark:bg-slate-900">
        <main>
            {{ $slot }}
        </main>
        
        @fluxScripts
        @stack('scripts')
    </body>
</html>
