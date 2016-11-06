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
