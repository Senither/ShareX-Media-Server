<div class="pt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 sm:space-x-4">
        <div class="p-6 bg-white dark:bg-dark-gray-800 bg-opacity-25 sm:shadow-xl sm:rounded-lg">
            <div class="flex justify-center items-center space-x-8">
                <div>
                    <div class="uppercase text-sm text-gray-400 dark:text-dark-gray-400">
                        Images
                    </div>
                    <div class="mt-1 text-5xl font-bold dark:text-dark-gray-200">
                        {{ number_format($images) }}
                    </div>
                </div>
                <!-- Heroicons : photograph -->
                <svg class="hidden sm:block h-16 w-16 text-gray-400 dark:text-dark-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-dark-gray-800 bg-opacity-25 sm:shadow-xl sm:rounded-lg">
           <div class="flex justify-center items-center space-x-8">
                <div>
                    <div class="uppercase text-sm text-gray-400 dark:text-dark-gray-400">
                        Text Files
                    </div>
                    <div class="mt-1 text-5xl font-bold dark:text-dark-gray-200">
                        {{ number_format($texts) }}
                    </div>
                </div>
                <!-- Heroicons : document-text -->
                <svg class="hidden sm:block h-16 w-16 text-gray-400 dark:text-dark-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-dark-gray-800 bg-opacity-25 sm:shadow-xl sm:rounded-lg">
           <div class="flex justify-center items-center space-x-8">
                <div>
                    <div class="uppercase text-sm text-gray-400 dark:text-dark-gray-400">
                        URLs
                    </div>
                    <div class="mt-1 text-5xl font-bold dark:text-dark-gray-200">
                        {{ number_format($urls) }}
                    </div>
                </div>
                <!-- Heroicons : link -->
                <svg class="hidden sm:block h-16 w-16 text-gray-400 dark:text-dark-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
            </div>
        </div>
    </div>
</div>
