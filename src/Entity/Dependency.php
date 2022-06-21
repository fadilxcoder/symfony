<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: [
        "get"
    ],
    itemOperations: [
        "get"
    ],
    paginationEnabled: false
)]
class Dependency
{
    #[ApiProperty(
        identifier: true
    )]
    private $uuid;

    #[ApiProperty(
        description: 'Name of the dependency'
    )]
    private $name;

    #[ApiProperty(
        description: 'Version of the dependency',
        openapiContext: [
            'example' => '7.8.6'
        ]
    )]
    private $version;

    public function __construct($uuid, $name, $version)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->version = $version;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVersion()
    {
        return $this->version;
    }
}
