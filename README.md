# Notes API platform with in-built swagger

## Setup

- `composer create-project symfony/skeleton <REPO>`
- `composer require api`
- Modify `.env` for DB connection
- `php bin/console doctrine:database:create && php bin/console doctrine:schema:create`
- Start symfony server : `symfony server:start`
- Added `composer require symfony/maker-bundle --dev`
- **NOTE** if `/api` is showing 404, install `composer require symfony/apache-pack`
- Add `Symfony profiler` by `composer req symfony/web-profiler-bundle` and verify URLs by `php bin/console debug:router`, then just go to `<URL>/_profiler`

## Documentation

- https://symfony.com/doc/current/components/serializer.html (The Serializer Component)
- https://api-platform.com/docs/core/serialization/ (The Serialization Process)
- https://api-platform.com/docs/core/operations/ (Operations)

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
- `normalizationContext` concerns more the `GET` and is related to when you are reading data from your API, so ALL endpoints that are tiggered will JSON response based on the `"groups"` they are connected to, i.e `read.post.collection`

````
 * @ApiResource(
 *     normalizationContext={
 *          "groups": {
 *              "read.post.collection"
 *          }
 *     }
 * )
 .
 .
class Post

.
.

 * @Groups(
 *     {
 *          "read.post.collection"
 *     }
 * )
 */
private $title;

````

- Collection operations : `GET` & `POST`
- Item operations : `GET` & `PUT` & `DELETE` & `PATCH`
- `itemOperations` for `put` has `denormalization_context` with group `write.post.item` and so does attribute `$id`, `$slug` and `$category`

````
 *          "put": {
 *              "denormalization_context": {
 *                  "groups": {
 *                      "write.post.item"
 *                  }
 *              }
 *          }
````
- So if you do a `PUT` with the following, `content` will **NOT** be updated

````
{
  "title": "Alternative Method",
  "slug": "api_platform.jsonld.normalizer.item",
  "content": "Just like other Symfony and API Platform components, the Serializer component can be configured using annotations, XML or YAML.",
  "category": "/api/categories/2"
}
````

- Using validation - rule on *Insert* only, will prevent from POST title < 5 characters & will allow PUT < 5 characters
- Validation on relationship between entity uses `@Assert\Valid()`
- Use for testing on *API Swagger*

````
{
  "title": "API Platform, c’est trop swag !",
  "slug": "creer-facilement-une-api-rest-avec-symfony-api-platform",
  "content": "Afin de découvrir la création avec API Platform , configurer une nouvelle application Symfony Flex.",
  "category": {
     "name": "MERN"
  }
}
````


- On Class

````
 *     collectionOperations={
 *          "get",
 *          "post": {
 *              "validation_groups": {
 *                  "create.post.item"
 *              }
 *          }
 *     },
````

- - On attribute `$title`

````
     * @Assert\Length(min=5, groups={"create.post.item"})
````
- - ManyToOne in `Post.php`

````
     * )
     * @Assert\Valid()
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts", cascade={"persist"})
     */
    private $category;
````

- - `$name` in `Category.php`

````
     * @Assert\Length(min=5, groups={"create.post.item"})
     */
    private $name;
````