<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @livewire('images.image-preview-list')

    @livewire('text.text-preview-list')
</x-app-layout>
