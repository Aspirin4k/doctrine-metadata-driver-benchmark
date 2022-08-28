<?php

namespace App\Static\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class ItemGroup
{
    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $metadata->setPrimaryTable([
            'table' => 'item_group',
        ]);
        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);

        $metadata->mapField([
            'fieldName' => 'id',
            'type' => 'integer',
            'id' => true,
        ]);


        $metadata->mapField([
            'fieldName' => 'externalId',
            'type' => 'string',
        ]);
        $metadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
        ]);
        $metadata->mapManyToMany([
            'fieldName' => 'items',
            'inversedBy' => 'groups',
            'targetEntity' => Item::class,
            'joinTable' => [
                'name' => 'item_in_group',
            ],
        ]);
    }

    private int $id;
    private string $externalId;
    private string $name;
    private Collection $items;
}
