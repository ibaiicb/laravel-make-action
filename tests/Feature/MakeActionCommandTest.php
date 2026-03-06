<?php

use Illuminate\Support\Facades\File;

it('creates an action class in the default namespace', function () {
    $actionPath = app_path('Actions/SendWelcomeEmail.php');

    File::delete($actionPath);

    $this->artisan('make:action', ['name' => 'SendWelcomeEmail'])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();

    $content = File::get($actionPath);
    expect($content)
        ->toContain('namespace App\Actions;')
        ->toContain('class SendWelcomeEmail')
        ->toContain('public function handle(): void');

    File::delete($actionPath);
});

it('creates an action in a nested namespace', function () {
    $actionPath = app_path('Actions/Auth/LoginUser.php');

    File::delete($actionPath);

    $this->artisan('make:action', ['name' => 'Auth/LoginUser'])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();

    $content = File::get($actionPath);
    expect($content)
        ->toContain('namespace App\Actions\Auth;')
        ->toContain('class LoginUser');

    File::delete($actionPath);
});

it('creates an action in a deeply nested namespace', function () {
    $actionPath = app_path('Actions/Billing/Subscription/CancelSubscription.php');

    File::delete($actionPath);

    $this->artisan('make:action', ['name' => 'Billing/Subscription/CancelSubscription'])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();

    $content = File::get($actionPath);
    expect($content)
        ->toContain('namespace App\Actions\Billing\Subscription;')
        ->toContain('class CancelSubscription');

    File::delete($actionPath);
});

it('fails if the action already exists without --force', function () {
    $actionPath = app_path('Actions/DuplicateAction.php');

    $this->artisan('make:action', ['name' => 'DuplicateAction'])
        ->assertSuccessful();

    $this->artisan('make:action', ['name' => 'DuplicateAction'])
        ->assertFailed();

    File::delete($actionPath);
});

it('overwrites an existing action with --force', function () {
    $actionPath = app_path('Actions/DuplicateAction.php');

    $this->artisan('make:action', ['name' => 'DuplicateAction'])
        ->assertSuccessful();

    $this->artisan('make:action', ['name' => 'DuplicateAction', '--force' => true])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();

    File::delete($actionPath);
});

it('creates an invokable action with --invokable', function () {
    $actionPath = app_path('Actions/ProcessPayment.php');

    File::delete($actionPath);

    $this->artisan('make:action', ['name' => 'ProcessPayment', '--invokable' => true])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();

    $content = File::get($actionPath);
    expect($content)
        ->toContain('public function __invoke(): void')
        ->not->toContain('public function handle()');

    File::delete($actionPath);
});

it('creates a queued action with --queued', function () {
    $actionPath = app_path('Actions/SendNotification.php');

    File::delete($actionPath);

    $this->artisan('make:action', ['name' => 'SendNotification', '--queued' => true])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();

    $content = File::get($actionPath);
    expect($content)
        ->toContain('implements ShouldQueue')
        ->toContain('use Illuminate\Contracts\Queue\ShouldQueue');

    File::delete($actionPath);
});

it('creates a test file when using --test', function () {
    $actionPath = app_path('Actions/SendEmail.php');
    $testPath = base_path('tests/Feature/Actions/SendEmailTest.php');

    File::delete([$actionPath, $testPath]);

    $this->artisan('make:action', ['name' => 'SendEmail', '--test' => true])
        ->assertSuccessful();

    expect(File::exists($actionPath))->toBeTrue();
    expect(File::exists($testPath))->toBeTrue();

    $testContent = File::get($testPath);
    expect($testContent)->toContain("test('SendEmail'");

    File::delete([$actionPath, $testPath]);
});
