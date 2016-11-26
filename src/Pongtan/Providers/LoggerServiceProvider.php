<?php


namespace Pongtan\Providers;


use Pongtan\Support\ServiceProviderInterface;

class LoggerServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton('log', function () {
            $log = new MonoLogger(config('app.name'));
            $log->pushHandler(new StreamHandler(app()->getBasePath() . "/storage/logs/fish.log", config('app.log_level')));
            return $log;
        });
    }

    public function boot()
    {
    }
}