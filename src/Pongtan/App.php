<?php

namespace Pongtan;

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Filesystem\Filesystem;
use Pongtan\Services\Config;
use Pongtan\Services\Factory;
use Slim\App as SlimApp;
use Slim\Container;

class App extends SlimApp
{
    private $basePath;

    /**
     * @var Config
     */
    public $config;

    /**
     * @var \Illuminate\Translation\Translator
     */
    public $lang;

    public $fileSystem;

    public $environment;

    public static $instance;

    /**
     * App constructor.
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->setBasePath($basePath);
        $this->init();
        $container = new Container;
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
    public function getBasePath()
    {
        return $this->basePath;
    }

    public function init()
    {
    }

    public function registerConfig()
    {
        $this->config = new Config();
        $this->fileSystem = new Filesystem();
        $this->environment = $this->getEnvironment();
        $this->config->loadConfigFiles($this->basePath . '/config');
    }


    /**
     * @param $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getEnvironment()
    {
        $environment = '';
        $environmentPath = $this->basePath . '/.env';
        if ($this->fileSystem->isFile($environmentPath)) {
            $environment = trim($this->fileSystem->get($environmentPath));
            $envFile = $this->basePath . '/.' . $environment;

            if ($this->fileSystem->isFile($envFile . '.env')) {
                $dotEnv = new Dotenv($this->basePath . '/', '.' . $environment . '.env');
                $dotEnv->load();
            }
        }
        return $environment;
    }

    /**
     * Boot Eloquent
     */
    public function registerEloquent()
    {
        $capsule = new Capsule;
        $config = $this->config->get('database.connections');
        foreach ($config as $k => $v) {
            $capsule->addConnection($v, $k);
        }
        $default = $this->config->get('database')['default'];
        if ($default) {
            if (isset($config[$default])) {
                $capsule->addConnection($config[$default], 'default');
            }
        }
        $capsule->bootEloquent();
    }

    public function registerLang()
    {
        $this->lang = Factory::getLang();
    }

}