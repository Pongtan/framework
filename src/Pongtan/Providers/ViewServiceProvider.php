<?php

namespace Pongtan\Providers;

use Pongtan\Contracts\ServiceProviderInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Pongtan\Twig\Extension\PhpFunctionExtension;

class ViewServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton('view', function () {
            $config = config('view');
            $loader = new Twig_Loader_Filesystem($config['paths']);
            $twig = new Twig_Environment($loader, array(
                'cache' => $config['compiled'],
                'auto_reload' => true,
            ));
            $ext = new PhpFunctionExtension(config('view.enable_functions'));
            $twig->addExtension($ext);

            return $twig;
        });
    }

    public function boot()
    {
    }
}
