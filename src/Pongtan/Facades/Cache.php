<?php

namespace Pongtan\Facades;

use Psr\SimpleCache\CacheInterface;

class Cache
{
    /**
     * @return CacheInterface
     */
    public static function getCacheDriver()
    {
        return app()->make('cache');
    }

    /**
     * @param $key
     * @param $value
     * @param $ttl
     * @return bool
     */
    public function set($key, $value, $ttl)
    {
        return self::getCacheDriver()->set($key, $value, $ttl);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return self::getCacheDriver()->get($key);
    }

    /**
     * @param $key
     */
    public function del($key)
    {
        return self::getCacheDriver()->delete($key);
    }
}