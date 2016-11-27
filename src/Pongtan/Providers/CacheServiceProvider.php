<?php


namespace Pongtan\Providers;


use Pongtan\SimpleCache\RedisCache;
use Pongtan\Contracts\ServiceProviderInterface;
use Predis\Client;

class CacheServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton('cache', function () {
            // @todo others cache driver support
            $config = config('database.redis.default');
            $client = new Client($config);
            return new RedisCache($client);
        });
    }

    public function boot()
    {
    }
}