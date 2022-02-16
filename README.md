# NOTES

- Symfony 6 & API platform 2.6.8
- `composer require symfony/apache-pack` - (https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules)
- Uses SQLite Database
- http://symfony-api-platform-react-js-udemy.test:8080/ (Normal route)
- http://symfony-api-platform-react-js-udemy.test:8080/api (API Platform)

### Refactoring of any PHP code

- https://packagist.org/packages/rector/rector
- https://github.com/rectorphp/rector
- `composer require rector/rector --dev`
- `vendor/bin/rector init` - Create `rector.php`
- `vendor/bin/rector process src --dry-run` - Rector will show you diff of files that it would change.
- NOTE : In windows CMD, run `.\vendor\bin\rector process src --dry-run`