# NOTES

- `composer req api` : Installation of API platform
- Headers : *Accept : application/ld+json*
- Entity exposed to API : `src\Entity\Comment.php`
- Configuration files : `config\packages\api_platform.yaml` & `config\packages\nelmio_cors.yaml`
- `collectionOperations` - related to collection
- `itemOperations` - related to 1 item *(id as parameter)*

 # Resources

- https://symfony.com/doc/current/the-fast-track/en/26-api.html (Exposing an API with API Platform)
- https://api-platform.com/docs/core/configuration/ (Configuration `config\packages\api_platform.yaml`)
- https://api-platform.com/docs/core/filters/ (Filters)
- https://api-platform.com/docs/core/controllers/#creating-custom-operations-and-controllers (Custom Operations and Controllers)

# Requests URLs

- http://demo.symfony.local/api/comments?page=1
- http://demo.symfony.local/api/comments?post=31
- http://demo.symfony.local/api/comments?post=31&page=2