# Notes

## Setup

- `composer create-project symfony/skeleton <REPO>`
- `composer require api`
- Modify `.env` for DB connection
- `php bin/console doctrine:database:create && php bin/console doctrine:schema:create`
- Start symfony server : `symfony server:start`
- Added `composer require symfony/maker-bundle --dev`
- *NOTE* if `/api` is showing 404, install `composer require symfony/apache-pack`