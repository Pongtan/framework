<?php

namespace Pongtan\Providers;

use Illuminate\Filesystem\Filesystem;
use Pongtan\Services\Config;
use Pongtan\Contracts\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getEnvironment()
    {
        $fileSystem = new Filesystem();
        $environment = '';
        $environmentPath = app()->getBasePath().'/.env';
        if ($fileSystem->isFile($environmentPath)) {
            $environment = trim($fileSystem->get($environmentPath));
            $envFile = app()->getBasePath().'/.'.$environment;

            if ($fileSystem->isFile($envFile.'.env')) {
                $dotEnv = new Dotenv(app()->getBasePath().'/', '.'.$environment.'.env');
                $dotEnv->load();
            }
        }

        return $environment;
    }

    public function register()
    {
        app()->singleton('config', function () {
            $config = new Config();
            $environment = $this->getEnvironment();
            $config->loadConfigFiles(app()->getBasePath().'/config');

            return $config;
        });
    }

    public function boot()
    {
    }
}
