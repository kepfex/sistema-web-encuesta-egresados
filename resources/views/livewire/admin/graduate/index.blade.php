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

    <div class="flex justify-between items-end mb-4">
        <div class="relative flex w-full max-w-20 flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="os" class="w-fit pl-0.5 text-sm">Por página</label>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="absolute pointer-events-none right-4 top-8 size-5">
                <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
            <select wire:model.live="paginarX"
                class="w-full appearance-none rounded-md border border-outline bg-surface-alt px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </div>

        <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" aria-hidden="true"
                class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-on-surface/50 dark:text-on-surface-dark/50">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input wire:model.live="search" type="search"
                class="w-full rounded-md border border-outline bg-surface-alt py-2 pl-10 pr-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark"
                name="search" placeholder="Buscar" aria-label="search" placeholder="Buscar por nombre o DNI..." />
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nombre Completo</th>
                    <th scope="col" class="px-6 py-3">DNI</th>
                    <th scope="col" class="px-6 py-3">Programa de Estudio</th>
                    <th scope="col" class="px-6 py-3">Año Egreso</th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Acciones</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($graduates as $graduate)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $graduate->id }}</td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $graduate->nombre_completo }}
                        </th>
                        <td class="px-6 py-4">{{ $graduate->dni }}</td>
                        <td class="px-6 py-4">{{ $graduate->programa->nombre ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $graduate->anio_egreso }}</td>
                        <td class="px-6 py-4 text-right">
                            <a wire:navigate href="{{ route('admin.graduates.show', $graduate) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Ver Encuesta
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">No se encontraron egresados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $graduates->links() }}
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
