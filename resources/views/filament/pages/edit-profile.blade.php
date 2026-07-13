<x-filament-panels::page>
    <x-filament-schemas::form wire:submit="save">
        {{ $this->form }}

        <x-filament::actions :actions="$this->getFormActions()" />
    </x-filament-schemas::form>
</x-filament-panels::page>