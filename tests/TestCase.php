<?php

namespace Pongtan\Tests;

use Pongtan\App;
use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @return App
     */
    public function getApp()
    {
        return new App(__DIR__.'/../');
    }
}
