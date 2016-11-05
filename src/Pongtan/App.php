<?php

namespace Pongtan;

use Dotenv\Dotenv;
use Illuminate\Filesystem\Filesystem;
use Pongtan\Services\Config;
use Slim\App as SlimApp;

class App extends SlimApp
{
    private $basePath;

    public $config;

    public $fileSystem;

    public $environment;

    /**
     * App constructor.
     * @param $basePath
     */
    public function __construct($basePath)
    {
        $this->setBasePath($basePath);
        $this->init();
    }

    public function init()
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
}