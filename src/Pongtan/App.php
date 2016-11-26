<?php

namespace Pongtan;

use Illuminate\Container\Container;
use Pongtan\Services\Config;
use Slim\App as SlimApp;
use Slim\Container as SlimContainer;

class App extends SlimApp
{
    private $basePath;

    /**
     * @var Container
     */
    private $container;


    public static $instance;

    /**
     * App constructor.
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->setBasePath($basePath);
        $this->init();
        $container = new SlimContainer;
        parent::__construct($container);
        self::$instance = $this;
    }

    /**
     * @return App
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function container()
    {
        return $this->container();
    }

    /**
     * Register a shared binding in the container.
     *
     * @param  string|array $abstract
     * @param  \Closure|string|null $concrete
     * @return void
     */
    public function singleton($abstract, $concrete = null)
    {
        $this->container->singleton($abstract, $concrete);
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    public function init()
    {
        $this->container = new Container();
    }


    /**
     * @param $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @param $serviceClassName
     */
    public function register($serviceClassName)
    {
        // $service = new \ReflectionClass($serviceClassName);
        $service = new $serviceClassName;
        $service->register();
        $service->boot();
    }

    /**
     * @param $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, array $parameters = [])
    {
        return $this->container->make($abstract, $parameters);
    }

}