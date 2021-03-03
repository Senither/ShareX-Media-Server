<?php

if (!function_exists('isUsingDarkMode')) {
    /**
     * Check if the site should be rendered using dark mode.
     *
     * @return boolean
     */
    function isUsingDarkMode()
    {
        if (request()->user() && request()->user()->theme == 'dark') {
            return true;
        }

        return app('settings')->get('app.theme') == 'dark';
    }
}
