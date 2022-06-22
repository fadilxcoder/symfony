<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @Table(name="app_deploy")
 */
#[ApiResource(
    collectionOperations: [
        "post",
        "get"
    ],
    itemOperations: [
        "get"
    ],
    paginationEnabled: false
)]
class App
{
    #[ApiProperty(
        identifier: true
    )]
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

        /**
     * @ORM\Column(type="string", length=255)
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    public function __construct($reference, $date)
    {
        $this->uuid = Uuid::uuid5(Uuid::NAMESPACE_URL, $reference)->toString();
        $this->reference = $reference;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getDate()
    {
        return $this->date;
    }
}
