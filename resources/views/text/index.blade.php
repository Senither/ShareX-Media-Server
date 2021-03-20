<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Your Text Files') }}
            </h2>

            @livewire('text.upload-text-modal-form')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('text.paginated-text-list')
        </div>
    </div>
</x-app-layout>
