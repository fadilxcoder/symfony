# NOTES

- Symfony 6 & API platform 2.6.8
- `composer require symfony/apache-pack` - (https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules)
- SQLite DB
- **URL** : http://symfony-api-platform-react-js-udemy.test:8080/ (Normal route)
- **URL** : http://symfony-api-platform-react-js-udemy.test:8080/api (API Platform)
- https://regex101.com/ (Regex creation)
- - Password regex : https://regex101.com/r/CbKzlO/1
- Event subscriber for hashing password before inserting in DB
- Load fixtures for database - `php bin\console doctrine:fixtures:load`
- Constraint validation in **User** entity
- - **Confirm password validation**
````
     * @Assert\Expression(
     *     message="Password does not match",
     *     "this.getPassword() === this.getRetypePassword()"
     * )
````
- JWT
- - `composer require lexik/jwt-authentication-bundle` (https://packagist.org/packages/lexik/jwt-authentication-bundle)
- Generate fresh keys in cygwin and copy/paste to project
- https://jwt.io/
- - `openssl genrsa -out config/jwt/private.pem 4096`
- - `openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`
- Postman
- - Dynamic variables (https://learning.postman.com/docs/writing-scripts/script-references/variables-list)
- - Pre-request script to get JWT in environment and then make actual query

### Refactoring of any PHP code

- https://packagist.org/packages/rector/rector
- https://github.com/rectorphp/rector
- - `composer require rector/rector --dev`
- - `vendor/bin/rector init` - Create `rector.php`
- - `vendor/bin/rector process src --dry-run` - Rector will show you diff of files that it would change.
- NOTE : In windows CMD, run `.\vendor\bin\rector process src --dry-run`