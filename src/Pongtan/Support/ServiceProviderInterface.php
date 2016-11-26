<?php


namespace Pongtan\Support;


interface ServiceProviderInterface
{
    public function register();

    public function boot();
}