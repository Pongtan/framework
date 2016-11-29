<?php

namespace Pongtan\Providers;

use Pongtan\Services\Factory;
use Pongtan\Contracts\ServiceProviderInterface;

class LangServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton('lang', function () {
            return Factory::getLang();
        });
    }

    public function boot()
    {
    }
}
