<?php

namespace Pongtan;

use Dotenv\Dotenv;
use Illuminate\Filesystem\Filesystem;
use Pongtan\Services\Config;
use Slim\App as SlimApp;

class App extends SlimApp
{
    public $basePath;

    public $config;

    public $fileSystem;

    public $environment;

    /**
     * App constructor.
     * @param $bathPath
     */
    public function __construct($bathPath)
    {
        $this->setBasePath($bathPath);
        $this->init();
    }

    public function init()
    {
        $this->config = new Config();
        $this->fileSystem = new Filesystem();
        $this->environment = $this->getEnvironment();
        $this->config->loadConfigFiles($this->bathPath . '/config');
    }

    /**
     * @param $bathPath
     */
    public function setBasePath($bathPath)
    {
        $this->basePath = $bathPath;
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getEnvironment()
    {
        $environment = '';
        $environmentPath = $this->bathPath . '/.env';
        if ($this->fileSystem->isFile($environmentPath)) {
            $environment = trim($this->fileSystem->get($environmentPath));
            $envFile = $this->bathPath . '/.' . $environment;

            if ($this->fileSystem->isFile($envFile . '.env')) {
                $dotEnv = new Dotenv($this->bathPath . '/', '.' . $environment . '.env');
                $dotEnv->load();
            }
        }
        return $environment;
    }
}