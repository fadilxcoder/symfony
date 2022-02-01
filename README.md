# NOTES

- `composer require symfony/apache-pack` - (https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules)
- Uses SQLite Database
- http://symfony-api-platform-react-js-udemy.test:8080/ (Normal route)
- http://symfony-api-platform-react-js-udemy.test:8080/api (API Platform)
- Easy Admin
- - `composer req admin`
- - `php bin/console make:admin:dashboard`
- - `php bin/console make:admin:crud`
- - http://symfony-api-platform-react-js-udemy.test:8080/admin (Easy Admin Panel)
- - https://symfony.com/doc/current/EasyAdminBundle/index.html (EasyAdmin Documentation)

### Refactoring of any PHP code

- https://packagist.org/packages/rector/rector
- https://github.com/rectorphp/rector
- `composer require rector/rector --dev`
- `vendor/bin/rector init` - Create `rector.php`
- `vendor/bin/rector process src --dry-run` - Rector will show you diff of files that it would change.