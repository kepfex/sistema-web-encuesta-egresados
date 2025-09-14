<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>{{__('Dashboard')}}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.programs.index')" wire:navigate>Programas de Estudio
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $breadcrumbsText }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <div class="mb-6 mt-4">
        <h1 class="text-3xl font-black dark:text-white">{{$title}}</h1>
    </div>

    <div class="flex-1 self-stretch max-md:pt-6">
        <form wire:submit.prevent='save' class="my-6 w-full space-y-6">
            @csrf
            <div class="mt-5 w-full max-w-lg flex flex-col gap-4 mb-4">
                <flux:input wire:model.defer="form.nombre" :label="__('Nombre')" type="text"
                    :placeholder="__('Nombre del programa de estudio')" />
            </div>
            <div class="flex items-center gap-3">
                <flux:button variant="primary" type="submit" class="cursor-pointer">{{ $buttonText }}</flux:button>
                <flux:button :href="route('admin.programs.index')" wire:navigate>Cancelar </flux:button>
            </div>
        </form>
    </div>
</div>
