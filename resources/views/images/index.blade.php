<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Your Images') }}
            </h2>

            @livewire('images.upload-image-modal-form')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('images.paginated-image-list')
        </div>
    </div>
</x-app-layout>
