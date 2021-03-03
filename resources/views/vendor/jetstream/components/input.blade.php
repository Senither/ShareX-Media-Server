@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:text-dark-gray-200 border-gray-300 dark:border-dark-gray-600 focus:border-indigo-300 dark:focus:border-dark-gray-600 focus:ring-1 dark:focus:ring-dark-gray-800 dark:bg-dark-gray-800 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
