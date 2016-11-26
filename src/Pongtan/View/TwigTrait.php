<?php


namespace Pongtan\View;

use Pongtan\Twig\Extension\PhpFunctionExtension;
use Twig_Environment;
use Twig_Loader_Filesystem;

trait TwigTrait
{

    /**
     * @return Twig_Environment
     */
    public function twig()
    {
        $config = config('view');
        $loader = new Twig_Loader_Filesystem($config['paths']);
        $twig = new Twig_Environment($loader, array(
            'cache' => $config['compiled'],
        ));
        $ext = new PhpFunctionExtension(['config', 'lang']);
        $twig->addExtension($ext);
        return $twig;
    }

    /**
     * @param $name
     * @param array $context
     * @return string
     */
    public function view($name, array $context = [])
    {
        return $this->twig()->render($name, $context);
    }
}
