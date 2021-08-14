# Notes API platform with in-built swagger

## Setup

- `composer create-project symfony/skeleton <REPO>`
- `composer require api`
- Modify `.env` for DB connection
- `php bin/console doctrine:database:create && php bin/console doctrine:schema:create`
- Start symfony server : `symfony server:start`
- Added `composer require symfony/maker-bundle --dev`
- **NOTE** if `/api` is showing 404, install `composer require symfony/apache-pack`

## Documentation

- https://symfony.com/doc/current/components/serializer.html (The Serializer Component)
- https://api-platform.com/docs/core/serialization/ (The Serialization Process)

## Database Structure

- Post : `1 Post has 1 Category`
- Category : `1 Category has 1/∞ Post`

## Usage

- Enabling crud endpoints can be done in 2 ways, need to modify `config/api_platform.yaml`
- - Using `Entity`, check `src/Entity/Post.php`
- - Using`yaml`, check `config/api_platform/resources.yaml`
- To activate API CRUD endpoints of an Entity, add `@ApiResource()` in class phpdocs
- To insert into *Post* with Swagger - "**POST `/api/posts`**"

````
{
  "title": "A web interface allows you to interact with the API",
  "slug": "linkedin-skill-assessments-quizzes",
  "content": "You want a method with behavior similar to a virtual method--it is meant to be overridden --expect that it does not have a method body. It just has a method signature.",
  "createdAt": "2021-08-14",
  "updatedAt": "2021-08-14",
  "category" : "/api/categories/2"
}
````
- `normalizationContext` concerns more the `GET` and is related to when you are reading data from your API