<div class="m-6 flex flex-col">
    <a class="flex flex-1" href="{{ $url->resource_url }}" target="blank">
        <div class="p-2 mb-1 flex flex-col w-full text-center overflow-ellipsis dark:bg-dark-gray-800 rounded shadow-md transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            <img
                class="flex flex-1"
                src="{{ route('view-url', [$url, 'preview']) }}"
                alt="{{ $url->name }}"
                onerror="this.onerror=null; this.src='{{ asset('vendor/vscode-material-icon-theme/icons/url.svg') }}'"
            >

            <p class="pt-2 text-xs dark:text-dark-gray-200">Visited {{ $url->visits }} times!</p>
        </div>
    </a>

    <div class="p-2 mt-2 items-end grid grid-cols-2 text-center bg-white dark:bg-dark-gray-800 rounded-md border-b border-gray-200 dark:border-dark-gray-900 shadow-md divide-x dark:divide-dark-gray-500">
        <a class="hover:text-gray-500 dark:text-dark-gray-200 dark:hover:text-dark-gray-400" href="{{ $url->resource_url }}" target="blank">View</a>
        <a class="text-red-500 hover:text-red-400 cursor-pointer" wire:click="delete">Delete</a>
    </div>
</div>
