# Contributing

Contributions are welcome, and are accepted via pull requests. Please review these guidelines before submitting any pull requests.

## How to contribute

1. **Fork** the repository and create a branch from `develop`:
   ```bash
   git checkout -b feature/my-feature
   ```

2. **Make your changes** — keep them focused and minimal.

3. **Write or update tests** to cover your changes:
   ```bash
   composer test
   ```

4. **Run the code style fixer** (PSR-2 via Laravel Pint):
   ```bash
   composer format
   ```

5. **Run static analysis** (PHPStan level 5):
   ```bash
   composer analyse
   ```

6. **Update `CHANGELOG.md`** under the `[Unreleased]` section.

7. **Open a Pull Request** against the `develop` branch with a clear description of the change.

## Guidelines

- Please follow the PSR-2 Coding Style Guide, enforced by Laravel Pint.
- Ensure that the current tests pass, and if you've added something new, add the tests where relevant.
- Ensure that PHPStan passes.
- Send a coherent commit history, making sure each individual commit in your pull request is meaningful.
- You may need to [rebase](https://git-scm.com/book/en/v2/Git-Branching-Rebasing) to avoid merge conflicts.
- If you are changing the behaviour, update the `README.md` accordingly.
- Please remember that we follow [SemVer](https://semver.org/).

## Reporting bugs

Please open an issue on GitHub with:
- Laravel and PHP version
- Steps to reproduce
- Expected vs actual behaviour
