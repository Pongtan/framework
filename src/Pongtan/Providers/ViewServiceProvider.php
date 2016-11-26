<?php


namespace Pongtan\Providers;

use Pongtan\Support\ServiceProviderInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

class ViewServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton('view', function () {
            $config = config('view');
            $loader = new Twig_Loader_Filesystem($config['paths']);
            $twig = new Twig_Environment($loader, array(
                'cache' => $config['compiled'],
            ));
            $ext = new PhpFunctionExtension(['config', 'lang']);
            $twig->addExtension($ext);
            return $twig;
        });
    }

    public function boot()
    {
    }
}