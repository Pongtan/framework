<?php


namespace Pongtan\View;

use Twig_Environment;

trait TwigTrait
{

    /**
     * @return Twig_Environment
     */
    public function twig()
    {
        return app()->make('view');
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
