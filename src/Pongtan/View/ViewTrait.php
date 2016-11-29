<?php

namespace Pongtan\View;

trait ViewTrait
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
     *
     * @return string
     */
    public function view($name, array $context = [])
    {
        return $this->twig()->render($name . ".html", $context);
    }
}
