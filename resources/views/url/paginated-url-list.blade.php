<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" wire:poll.10s>
    <div class="bg-white dark:bg-dark-gray-700 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 dark:text-dark-gray-400">
            @if ($urls->isEmpty())
                <x-has-no-media :type="'URL'" />
            @else
                @foreach ($urls as $url)
                    @livewire('url.url-preview', ['url' => $url], key($url->id))
                @endforeach
            @endif
        </div>

        @if ($urls->hasPages())
            <div class="p-4 bg-gray-50 dark:bg-dark-gray-800 border-t dark:border-dark-gray-900">
                {{ $urls->links() }}
            </div>
        @endif
    </div>
</div>
