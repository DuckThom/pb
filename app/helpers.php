<?php

if (! function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function base_path($path = '')
    {
        return app()->basePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('public_path')) {
    /**
     * Get the path to the public directory.
     *
     * @param  string  $path
     * @return string
     */
    function public_path($path = '')
    {
        return base_path('public'.$path);
    }
}

if (! function_exists('secure_url')) {
    /**
     * Generate a https url.
     *
     * @param  string  $path
     * @param  array  $params
     * @return string
     */
    function secure_url($path = '', $params = [])
    {
        return url($path, $params, true);
    }
}
