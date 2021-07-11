<?php

if (!function_exists('isUsingDarkMode')) {
    /**
     * Check if the site should be rendered using dark mode.
     *
     * @return boolean
     */
    function isUsingDarkMode()
    {
        if (request()->user() && request()->user()->theme !== null) {
            return request()->user()->theme == 'dark';
        }

        return app('settings')->get('app.theme') == 'dark';
    }
}

if (!function_exists('convertByteToHuman')) {
    /**
     * Calculates the size and unit of the given amount of bytes.
     *
     * @return array
     */
    function convertByteToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return [
            'size' => round($bytes, 1),
            'unit' => $units[$pow],
        ];
    }
}
