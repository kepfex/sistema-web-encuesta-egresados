<div 
    x-data="{
        copyToClipboard(text) {
            if (navigator && navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    {{-- window.dispatchEvent(new CustomEvent('notify', {
                        detail: { 
                            variant: 'info', 
                            title: '¡Copiado!', 
                            message: 'URL copiada al portapapeles.' 
                        }
                    })); --}}
                    alert('URL copiada al portapapeles.');
                }).catch(err => {
                    alert('No se pudo copiar el enlace: ' + err);
                });
            } else {
                alert('Tu navegador no soporta copiar al portapapeles.');
            }
        }
    }"
>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $titulo }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <div class="flex justify-between items-center mb-6 mt-4">
        <h1 class="text-3xl font-black dark:text-white">{{ $titulo }}</h1>
        <a wire:navigate href="{{ route('admin.temporary-links.create') }}"
            class="px-5 py-2 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="w-5 h-5 me-2 icon icon-tabler icons-tabler-outline icon-tabler-link-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 15l6 -6" />
                <path d="M11 6l.463 -.536a5 5 0 0 1 7.072 0a4.993 4.993 0 0 1 -.001 7.072" />
                <path d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                <path d="M16 19h6" />
                <path d="M19 16v6" />
            </svg>
            Nuevo Enlace
        </a>
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
                name="search" placeholder="Buscar" aria-label="search" />
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full table-auto border-collapse text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-800  bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Campaña
                    </th>
                    <th scope="col" class="px-6 py-3">
                        URL (Token)
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Usos
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Expiración
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3 w-40 text-center">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($temporaryLinks  as $temporaryLink)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-3 font-medium text-gray-900">
                            {{ $temporaryLink->nombre_campania }}
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-2 justify-between">
                                 <span class="font-mono"> {{-- truncate max-w-[150px] --}}
                                    encuesta/{{ $temporaryLink->token }}
                                </span>
                                <button
                                    x-on:click="copyToClipboard('{{ url('/encuesta/' . $temporaryLink->token) }}')"
                                    class="text-gray-400 hover:text-blue-500 cursor-pointer" title="Copiar enlace">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 16h8m-8-4h8m2 8H6a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-center">
                            {{ $temporaryLink->usos_actuales }} /
                            {{ $temporaryLink->maximo_usos == 0 ? '∞' : $temporaryLink->maximo_usos }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $temporaryLink->fecha_expiracion ? $temporaryLink->fecha_expiracion->format('d/m/Y') : 'Nunca' }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            @if ($temporaryLink->esta_activo)
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            @else
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right flex space-x-2">
                            <a wire:navigate href="{{ route('admin.temporary-links.edit', $temporaryLink) }}"
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
                            <button
                                wire:click="$dispatch('open-confirm', { 
                                title: 'Eliminar Enlace de Encuestas', 
                                message: '¿Está segura/o de hacer esto?',  
                                id: {{ $temporaryLink->id }}, 
                                action: 'delete-temporary-link' 
                            })"
                                type="button"
                                class="cursor-pointer inline-flex items-center justify-center px-3 py-1 border border-red-500 rounded-md font-medium text-sm text-red-500 hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="w-4 h-4 mr-1 icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                <span>Eliminar</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <x-table-empty-state :colspan="6" :search="$search" title={{ $titulo }}
                            :createUrl="route('admin.temporary-links.create')" />
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $temporaryLinks->links() }}
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
