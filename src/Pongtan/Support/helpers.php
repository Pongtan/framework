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
