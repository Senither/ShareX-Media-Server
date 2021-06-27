<div class="pt-12" wire:poll.10s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-dark-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 flex items-center justify-between bg-white dark:bg-dark-gray-800 border-b border-gray-200 dark:border-dark-gray-500">
                <div class="text-xl dark:text-dark-gray-100">
                    Latest file uploads
                </div>

                <a href="{{ route('files') }}">
                    <div class="flex items-center text-sm font-semibold text-indigo-700 dark:text-indigo-300">
                        <div>View all files</div>

                        <div class="ml-1 text-indigo-500">
                            {{-- Heroicon: arrow-right --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd"
                                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-gray-200 dark:bg-dark-gray-700 bg-opacity-25 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                @if ($files->isEmpty())
                    <x-has-no-media :type="'files'" />
                @else
                    @foreach ($files as $file)
                        @livewire('files.file-preview', [
                        'file' => $file
                        ], key($file->id))
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
