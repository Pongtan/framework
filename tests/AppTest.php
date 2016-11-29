<?php

namespace Pongtan\Tests;

use Pongtan\Providers\LangServiceProvider;
use Pongtan\App;

class AppTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testApp()
    {
        $app = new App(__DIR__.'/../');
    }

    public function testServiceProvicer()
    {
        $app = $this->getApp();
        $app->register(LangServiceProvider::class);
    }
}
