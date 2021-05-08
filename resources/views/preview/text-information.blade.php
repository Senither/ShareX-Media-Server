<div class="absolute bottom-5 right-12">
    @if ($showModal)
        <div
             class="absolute bottom-12 right-5 p-4 w-64 {{ strlen($text->original_name) > 30 ? 'sm:w-96' : 'sm:w-80' }} bg-gray-900 text-white text-sm rounded shadow-md">
            <p class="pb-2 text-base font-bold text-center">File Information</p>

            <div class="divide-y divide-gray-800">
                <div class="flex justify-between">
                    <span class="text-indigo-400 font-semibold pr-2">ID</span>
                    <span class="overflow-hidden overflow-ellipsis">{{ $text->name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-indigo-400 font-semibold pr-2">Name</span>
                    <span class="overflow-hidden overflow-ellipsis">{{ $text->original_name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-indigo-400 font-semibold pr-2">Extension</span>
                    <span class="overflow-hidden overflow-ellipsis">{{ $text->extension }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-indigo-400 font-semibold pr-2">Lines</span>
                    <span class="overflow-hidden overflow-ellipsis">{{ $text->line_count }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-indigo-400 font-semibold pr-2">Words</span>
                    <span class="overflow-hidden overflow-ellipsis">{{ $text->word_count }}</span>
                </div>
            </div>
        </div>
    @endif

    <svg
         wire:click="$toggle('showModal')"
         class="absolute bottom-3 right-3 w-8 h-8 text-indigo-400 cursor-pointer"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
        </path>
    </svg>
</div>
