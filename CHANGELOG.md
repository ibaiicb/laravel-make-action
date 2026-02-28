# Changelog

All notable changes to `laravel-make-action` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- `make:action` Artisan command to generate Action classes
- Support for nested namespaces (e.g. `make:action Auth/LoginUser`)
- Support for Laravel 10, 11 and 12
- Support for PHP 8.1, 8.2, 8.3 and 8.4
- `--invokable` / `-i` option to generate actions with `__invoke()` instead of `handle()`
- `--queued` / `-q` option to generate actions implementing `ShouldQueue`
- `--test` option to generate an accompanying Pest test at `tests/Feature/Actions/`
- `--force` support to overwrite existing action files (inherited from Laravel's `GeneratorCommand`)
- Publishable stubs via `vendor:publish --tag=laravel-make-action-stubs` (`action.stub`, `action.invokable.stub`, `action.queued.stub`)
- Publishable config via `vendor:publish --tag=laravel-make-action-config`
- `config/make-action.php` to customise the default namespace (`Actions`) and method name (`handle`)
- GitHub Actions CI matrix covering PHP 8.1–8.4 × Laravel 10–12 with `prefer-stable` and `prefer-lowest`
- Code coverage job in CI with Codecov integration
- PHPStan static analysis at level 5 (`phpstan.neon.dist`) with dedicated GitHub Actions workflow
- Dependabot for weekly Composer dependency updates
- `CONTRIBUTING.md`, `SECURITY.md` and pull request template
