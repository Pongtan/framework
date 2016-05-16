<?php

use Pongtan\Services\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testConfig()
    {
        $key = "foo";
        $value = "bar";
        Config::set($key, $value);
        $this->assertEquals($value, Config::get($key));

        $true = 'true';
        $false = 'false';

        Config::set($key, $true);
        $this->assertEquals(true, Config::get($key));

        Config::set($key, $false);
        $this->assertEquals(false, Config::get($key));

    }

}