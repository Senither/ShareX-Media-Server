<div class="pt-12" wire:poll.10s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 flex items-center justify-between bg-white border-b border-gray-200">
                <div class="text-xl">
                    Latest text uploads
                </div>

                <a href="{{ route('text') }}">
                    <div class="flex items-center text-sm font-semibold text-indigo-700">
                        <div>View all text files</div>

                        <div class="ml-1 text-indigo-500">
                            {{-- Heroicon: arrow-right --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                @if($textFiles->isEmpty())
                    <p class="p-8 col-span-6 text-center">
                        You don't have any text uploads right now, create an <a class="text-indigo-700" href="{{ route('api-tokens.index') }}">API token</a> to start uploading text files.
                    </p>
                @else
                    @foreach($textFiles as $file)
                        @livewire('text.text-preview', [
                            'text' => $file
                        ], key($file->id))
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
