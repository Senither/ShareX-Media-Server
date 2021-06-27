<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @livewire('dashboard.stats')

    @livewire('images.image-preview-list')

    @livewire('text.text-preview-list')

    @livewire('files.file-preview-list')

    @livewire('url.url-preview-list')
</x-app-layout>
