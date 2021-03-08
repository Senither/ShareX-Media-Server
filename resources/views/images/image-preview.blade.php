<div class="m-6 flex flex-col">
    <a class="flex-1 flex items-center" href="{{ $image->resource_url }}" target="blank">
        <img
            class="rounded-sm shadow-md transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"
            loading="lazy"
            height="256"
            width="256"
            src="{{ route('view-image', [$image, '256x256']) }}"
            alt="{{ $image->name }}"
        >
    </a>

    <div class="p-2 mt-2 items-end grid grid-cols-2 text-center bg-white dark:bg-dark-gray-800 rounded-md border-b border-gray-200 dark:border-dark-gray-900 shadow-md divide-x dark:divide-dark-gray-500">
        <a class="hover:text-gray-500 dark:text-dark-gray-200 dark:hover:text-dark-gray-400" href="{{ $image->resource_url }}" target="blank">View</a>
        <a class="text-red-500 hover:text-red-400 cursor-pointer" wire:click="delete">Delete</a>
    </div>
</div>
