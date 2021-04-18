# NOTES

- `composer req api` : Installation of API platform
- Headers : *Accept : application/ld+json*
- Entity exposed to API : `src\Entity\Comment.php`
- Configuration files : `config\packages\api_platform.yaml` & `config\packages\nelmio_cors.yaml`
- `collectionOperations` - related to collection
- `itemOperations` - related to 1 item *(id as parameter)*
- Expose an entity property with **`@Groups({"read:comment"})`** or **`@Groups({"read:full:comment"})`**
- Use `"` instead of `'` when sending POST data

 # Resources

- https://symfony.com/doc/current/the-fast-track/en/26-api.html (Exposing an API with API Platform)
- https://api-platform.com/docs/core/configuration/ (Configuration `config\packages\api_platform.yaml`)
- https://api-platform.com/docs/core/filters/ (Filters)
- https://api-platform.com/docs/core/controllers/#creating-custom-operations-and-controllers (Custom Operations and Controllers)

# Requests URLs

- http://localhost:7575/api/comments/307 - By ID
- http://demo.symfony.local/api/comments?page=1 - Pagination
- http://demo.symfony.local/api/comments?post=31 - By Post
- http://demo.symfony.local/api/comments?post=31&page=2 - By Post & Pagination

# Codebase

## On class annotation

<pre>
 * @ApiResource(
 *      attributes={
 *          "order"= {"publishedAt": "DESC"},
 *      },
 *      paginationItemsPerPage=2,
 *      paginationPartial=false,
 *      normalizationContext={"groups"={"read:comment"}},
 *      collectionOperations={
 *          "get", 
 *          "post"={
 *              "controller"=App\Services\CommentCreateService::class
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={
 *                  "read:comment", "read:full:comment"
 *              }}
 *          }
 *      }
 * )
 * @ApiFilter(
 *      SearchFilter::class, properties={"post":"exact"}
 * )
</pre>

## On property annotation

<pre>
/**
  * @var \DateTime
  *
  * @ORM\Column(type="datetime")
  * @Groups({"read:comment"})
  */
private $publishedAt;
</pre>

## Controller class

<pre>
public function __invoke(Comment $data): Comment
{
  ...
}
</pre>