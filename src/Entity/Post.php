<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups": {
 *              "read.post.collection"
 *          }
 *     },
 *     itemOperations={
 *          "get": {
 *              "normalization_context": {
 *                  "groups": {
 *                      "read.post.collection",
 *                      "read.post.item"
 *                  }
 *              }
 *          },
 *          "put": {
 *              "denormalization_context": {
 *                  "groups": {
 *                      "write.post.item"
 *                  }
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups(
     *     {
     *          "read.post.collection"
     *     }
     * )
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups(
     *     {
     *          "read.post.collection",
     *          "write.post.item"
     *     }
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(
     *     {
     *          "read.post.collection",
     *          "write.post.item"
     *     }
     * )
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Groups(
     *     {
     *          "read.post.item"
     *     }
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups(
     *     {
     *          "read.post.item"
     *     }
     * )
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @Groups(
     *     {
     *          "read.post.item",
     *          "write.post.item"
     *     }
     * )
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
