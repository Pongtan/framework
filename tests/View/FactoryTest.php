<?php

use Pongtan\View\Factory;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testFactory(){
        $view = Factory::newSmarty();
    }
}