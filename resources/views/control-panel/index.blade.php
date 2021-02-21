<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Control Panel') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('control-panel.update-site-name-form')

            <x-jet-section-border />

            @livewire('control-panel.update-image-settings-form')
        </div>
    </div>
</x-app-layout>