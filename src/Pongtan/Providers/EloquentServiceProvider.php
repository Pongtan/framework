<?php

namespace Pongtan\Providers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Pongtan\Contracts\ServiceProviderInterface;

class EloquentServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
    }

    public function boot()
    {
        $capsule = new Capsule();
        $config = app()->make('config')->get('database.connections');
        foreach ($config as $k => $v) {
            $capsule->addConnection($v, $k);
        }
        $default = app()->make('config')->get('database')['default'];
        if ($default) {
            if (isset($config[$default])) {
                $capsule->addConnection($config[$default], 'default');
            }
        }
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
