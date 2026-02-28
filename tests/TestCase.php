<?php

namespace LaravelMakeAction\Tests;

use LaravelMakeAction\LaravelMakeActionServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelMakeActionServiceProvider::class,
        ];
    }
}
