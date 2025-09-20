<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $titulo }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <div class="flex justify-between items-center mb-6 mt-4">
        <h1 class="text-3xl font-black dark:text-white">{{ $titulo }}</h1>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full table-auto border-collapse text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-800  bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Denominación del año actual
                    </th>
                    <th scope="col" class="px-6 py-3 w-40 text-center">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($denominacions  as $denominacion)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-3 font-medium text-gray-900">
                            {{ $denominacion->denominacion }}
                        </td>
                        <td class="px-6 py-3 text-right flex space-x-2">
                            <a wire:navigate href="{{ route('admin.current-years.edit', $denominacion) }}"
                                class="inline-flex items-center justify-center px-3 py-1 border border-blue-500 rounded-md font-medium text-sm text-blue-500 hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="w-4 h-4 mr-1 icon icon-tabler icons-tabler-outline icon-tabler-pencil-minus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                    <path d="M13.5 6.5l4 4" />
                                    <path d="M16 19h6" />
                                </svg>
                                <span>Editar</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <p>No hay registros</p>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (session('notify'))
        <script>
            // Escucha el evento 'livewire:navigated', que se dispara en cada navegación de Livewire
            document.addEventListener('livewire:navigated', () => {
                // Despacha el evento 'notify' al objeto window para que AlpineJS lo capture
                window.dispatchEvent(
                    new CustomEvent('notify', {
                        detail: @json(session('notify'))
                    })
                );
            }, {
                once: true
            }); // { once: true } asegura que se ejecute solo una vez por navegación
        </script>
    @endif
</div>
