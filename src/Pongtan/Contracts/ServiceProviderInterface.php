<?php

namespace Pongtan\Contracts;

interface ServiceProviderInterface
{
    public function register();

    public function boot();
}
