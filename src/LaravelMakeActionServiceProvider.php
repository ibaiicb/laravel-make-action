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
            ->hasCommand(MakeActionCommand::class);
    }

    public function packageBooted(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../stubs' => base_path('stubs/vendor/laravel-make-action'),
            ], 'laravel-make-action-stubs');
        }
    }
}
