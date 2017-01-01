<?php

namespace Pongtan;

use Illuminate\Container\Container;
use Slim\App as SlimApp;
use Slim\Container as SlimContainer;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

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
     *
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->setBasePath($basePath);
        $this->init();
        $c = new SlimContainer();
        parent::__construct($c);
        $this->getContainer()['errorHandler'] = function ($c) {
            return function ($request, $response, Exception $exception) use ($c) {
                $log = app()->make('log');
                $log->error($exception->getMessage());
                foreach ($exception->getTrace() as $key => $row) {
                    if (!isset($row['function']) || !isset($row['line']) || !isset($row['file'])) {
                        $log->error(sprintf("#%s %s  %s ", $key, $row['function'], $row['class']));
                        continue;
                    }
                    $log->error(sprintf("#%s %s %s", $key, $row['file'], $row['line']));
                }
                // @todo add json support
                return $c['response']->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->write(app()->make('view')->render('error/500.html'));
            };
        };
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
     * @param string|array $abstract
     * @param \Closure|string|null $concrete
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
        $service = new $serviceClassName();
        $service->register();
        $service->boot();
    }

    /**
     * @param $abstract
     * @param array $parameters
     *
     * @return mixed
     */
    public function make($abstract, array $parameters = [])
    {
        return $this->container->make($abstract, $parameters);
    }
}
