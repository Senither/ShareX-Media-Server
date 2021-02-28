<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" wire:poll.10s>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
            @if($textFiles->isEmpty())
                <p class="p-8 col-span-6 text-center">
                    You don't have any text uploads right now, create an <a class="text-indigo-700" href="{{ route('api-tokens.index') }}">API token</a> to start uploading text files.
                </p>
            @else
                @foreach($textFiles as $text)
                    @livewire('text.text-preview', [
                        'text' => $text
                    ], key($text->id))
                @endforeach
            @endif
        </div>

        @if($textFiles->hasPages())
            <div class="p-4 bg-gray-50 border-t">
                {{ $textFiles->links() }}
            </div>
        @endif
    </div>
</div>
