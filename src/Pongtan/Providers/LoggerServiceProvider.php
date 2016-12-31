<?php

namespace Pongtan\Providers;

use Pongtan\Contracts\ServiceProviderInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton('log', function () {
            $log = new Logger(config('app.name'));
            $log->pushHandler(new StreamHandler(app()->getBasePath() . '/storage/logs/fish.log', config('app.log_level')));

            return $log;
        });
    }

    public function boot()
    {
    }
}
