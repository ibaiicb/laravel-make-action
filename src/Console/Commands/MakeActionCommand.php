<?php

namespace LaravelMakeAction\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeActionCommand extends GeneratorCommand
{
    protected $name = 'make:action';

    protected $description = 'Create a new Action class';

    protected $type = 'Action';

    public function handle(): int
    {
        if (parent::handle() === false) {
            return static::FAILURE;
        }

        if ($this->option('test')) {
            $this->createTest();
        }

        return static::SUCCESS;
    }

    protected function getStub(): string
    {
        $stub = match (true) {
            $this->option('invokable') => 'action.invokable',
            $this->option('queued')    => 'action.queued',
            default                    => 'action',
        };

        return $this->resolveStubPath($stub);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\\' . config('make-action.namespace', 'Actions');
    }

    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        return str_replace('{{ method }}', config('make-action.method', 'handle'), $stub);
    }

    protected function getOptions(): array
    {
        return array_merge(parent::getOptions(), [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the action even if it already exists'],
            ['invokable', 'i', InputOption::VALUE_NONE, 'Generate an invokable action with __invoke() method'],
            ['queued', null, InputOption::VALUE_NONE, 'Generate a queued action that implements ShouldQueue'],
            ['test', 't', InputOption::VALUE_NONE, 'Generate an accompanying Pest test for the action'],
        ]);
    }

    protected function resolveStubPath(string $stub): string
    {
        $published = base_path("stubs/vendor/laravel-make-action/{$stub}.stub");

        return file_exists($published)
            ? $published
            : __DIR__ . "/../../../stubs/{$stub}.stub";
    }

    protected function createTest(): void
    {
        $actionClass = Str::studly(class_basename($this->getNameInput()));
        $testName = $actionClass . 'Test';
        $testDirectory = base_path('tests/Feature/Actions');

        if (! is_dir($testDirectory)) {
            mkdir($testDirectory, 0777, true);
        }

        $testPath = $testDirectory . '/' . $testName . '.php';

        if (file_exists($testPath)) {
            $this->components->warn("Test [{$testPath}] already exists.");
            return;
        }

        $stub = file_get_contents($this->resolveStubPath('action.test'));
        $content = str_replace('{{ class }}', $actionClass, $stub);

        file_put_contents($testPath, $content);

        $this->components->info("Test [{$testPath}] created successfully.");
    }
}
