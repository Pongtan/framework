<?php

if (!function_exists('app')) {
    /**
     * @return \Pongtan\App
     */
    function app()
    {
        return \Pongtan\App::getInstance();
    }
}

if (!function_exists('config')) {
    function config($key)
    {
        return app()->config->get($key);
    }
}

if (!function_exists('base_path')) {
    function base_path($key = null)
    {
        $basePath = app()->getBasePath();
        if (!$key) {
            return $basePath;
        }
        return $basePath . $key;
    }
}

// env function from laravel framework
if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (strlen($value) > 1 && Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
