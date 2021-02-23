<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Control Panel') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('control-panel.update-general-site-settings-form')

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('control-panel.update-image-settings-form')
            </div>
        </div>
    </div>
</x-app-layout>
