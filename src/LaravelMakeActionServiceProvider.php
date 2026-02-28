<?php

namespace LaravelMakeAction;

use LaravelMakeAction\Console\Commands\MakeActionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMakeActionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-make-action')
            ->hasConfigFile('make-action')
            ->hasStubs(['action.stub', 'action.invokable.stub', 'action.queued.stub'])
            ->hasCommand(MakeActionCommand::class);
    }
}
