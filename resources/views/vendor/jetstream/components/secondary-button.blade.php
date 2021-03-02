<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-dark-gray-600 border border-gray-300 dark:border-dark-gray-800 rounded-md font-semibold text-xs text-gray-700 dark:text-dark-gray-400 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
