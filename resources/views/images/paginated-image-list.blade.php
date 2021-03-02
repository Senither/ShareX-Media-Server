<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" wire:poll.10s>
    <div class="bg-white dark:bg-dark-gray-700 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 dark:text-dark-gray-400">
            @if($images->isEmpty())
                <p class="p-8 col-span-6 text-center">
                    You don't have any image uploads right now, create an <a class="text-indigo-700 dark:text-indigo-400" href="{{ route('api-tokens.index') }}">API token</a> to start uploading images.
                </p>
            @else
                @foreach($images as $image)
                    @livewire('images.image-preview', [
                        'image' => $image
                    ], key($image->id))
                @endforeach
            @endif
        </div>

        @if($images->hasPages())
            <div class="p-4 bg-gray-50 border-t">
                {{ $images->links() }}
            </div>
        @endif
    </div>
</div>
