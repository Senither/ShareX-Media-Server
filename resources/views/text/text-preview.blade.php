<div class="m-6 flex flex-col">
    <a class="flex flex-1" href="{{ $text->resource_url }}" target="blank">
        <div class="p-2 mb-1 flex flex-col w-full text-center overflow-ellipsis rounded-sm shadow-md transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            <img
                class="flex flex-1"
                src="{{ asset('vendor/vscode-material-icon-theme/icons/' . $text->file_icon . '.svg') }}"
                alt="{{ $text->original_name }}"
                onerror="this.onerror=null; this.src='{{ asset('vendor/vscode-material-icon-theme/icons/url.svg') }}'"
            >

            <p class="pt-2 text-xs">{{ $text->original_name }}</p>
        </div>
    </a>

    <div class="p-2 items-end grid grid-cols-2 text-center bg-white rounded-md border-b border-gray-200 shadow-md divide-x">
        <a class="hover:text-gray-500" href="{{ $text->resource_url }}" target="blank">View</a>
        <a class="text-red-500 hover:text-red-400 cursor-pointer" wire:click="delete">Delete</a>
    </div>
</div>
