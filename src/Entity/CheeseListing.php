<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CheeseListingRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"
 *     },
 *     itemOperations={
 *          "get"={
 *              "path"="/yo-single-cheezzyy/{id}"
 *          },
 *          "put"
 *     },
 *      normalizationContext={
 *          "groups"={
 *              "cheese_listing:read"
 *          },
 *          "swagger_definition_name"="Read"
 *     },
 *     denormalizationContext={
 *          "groups"={
 *              "cheese_listing:write"
 *          },
 *          "swagger_definition_name"="Write"
 *     },
 *     shortName="cheeses",
 *     attributes={
 *          "pagination_items_per_page"=15,
 *          "formats"={
 *              "jsonld",
 *              "json",
 *              "html",
 *              "jsonhal",
 *              "csv"={
 *                  "text/csv"
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass=CheeseListingRepository::class)
 * @ApiFilter(
 *     BooleanFilter::class,
 *     properties={
 *          "isPublished"
 *     }
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *          "title": "partial",
 *          "description": "partial"
 *     }
 * )
 * @ApiFilter(
 *     RangeFilter::class,
 *     properties={
 *          "price"
 *     }
 * )
 * @ApiFilter(
 *     PropertyFilter::class
 * )
 */
class CheeseListing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(
     *     {
     *          "cheese_listing:read",
     *          "cheese_listing:write"
     *     }
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups(
     *     {
     *          "cheese_listing:read"
     *     }
     * )
     */
    private $description;

    /**
     * The price of the delicious cheese
     *
     * @ORM\Column(type="integer")
     * @Groups(
     *     {
     *          "cheese_listing:read",
     *          "cheese_listing:write"
     *     }
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->isPublished = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @Groups(
     *     {
     *          "cheese_listing:read"
     *     }
     * )
     */
    public function getShortDescription(): ?string
    {
        if (strlen($this->description) < 40) {
            return $this->description;
        }

        return substr($this->description, 0, 40) . '...';
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Raw text
     *
     * @param string $description
     *
     * @return $this
     *
     * @Groups(
     *     {
     *          "cheese_listing:write"
     *     }
     * )
     *
     * @SerializedName("description")
     */
    public function setTextDescription(string $description): self
    {
        $this->description = nl2br($description);

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Return how long ago this object was created !
     *
     * @return string
     * @Groups(
     *     {
     *          "cheese_listing:read"
     *     }
     * )
     */
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->getCreatedAt())->diffForHumans();
    }
/*
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
*/
    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
