<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Dependency;
use Ramsey\Uuid\Uuid;

class DependencyDataprovider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface, ItemDataProviderInterface
{
    public function __construct(private array $rootPath)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Dependency::class;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $items = [];
        foreach ($this->getDependencies() as $name => $version) {
            $items[] = new Dependency(Uuid::uuid5(Uuid::NAMESPACE_URL, $name)->toString(), $name, $version);
        }

        return $items;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        foreach ($this->getDependencies() as $name => $version) {
            $uuid = Uuid::uuid5(Uuid::NAMESPACE_URL, $name)->toString();
            if ($uuid === $id) {
                return new Dependency($uuid, $name, $version);
            }
        }
    }

    private function getDependencies()
    {
        $composerJsonPath = $this->rootPath[0] . '/composer.json';
        $json = json_decode(file_get_contents($composerJsonPath), true);

        return $json['require'];
    }
}
