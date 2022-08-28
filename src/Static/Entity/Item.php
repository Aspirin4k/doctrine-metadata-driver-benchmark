<?php

namespace App\Static\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class Item
{
    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $metadata->setPrimaryTable([
            'table' => 'item',
        ]);
        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);

        $metadata->mapField([
            'fieldName' => 'id',
            'type' => 'integer',
            'id' => true,
        ]);
        $metadata->mapField([
            'fieldName' => 'sku',
            'type' => 'string',
        ]);
        $metadata->mapField([
            'fieldName' => 'type',
            'type' => 'string',
        ]);
        $metadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
        ]);
        $metadata->mapField([
            'fieldName' => 'description',
            'type' => 'string',
        ]);
        $metadata->mapField([
            'fieldName' => 'shopId',
            'type' => 'integer',
        ]);
        $metadata->mapField([
            'fieldName' => 'isFree',
            'type' => 'boolean',
        ]);
        $metadata->mapField([
            'fieldName' => 'isEnabled',
            'type' => 'boolean',
        ]);
        $metadata->mapField([
            'fieldName' => 'isDeleted',
            'type' => 'boolean',
        ]);
        $metadata->mapOneToMany([
            'fieldName' => 'prices',
            'mappedBy' => 'item',
            'targetEntity' => ItemPrice::class,
        ]);
        $metadata->mapOneToMany([
            'fieldName' => 'media',
            'mappedBy' => 'item',
            'targetEntity' => ItemMedia::class,
        ]);
        $metadata->mapOneToMany([
            'fieldName' => 'attributes',
            'mappedBy' => 'item',
            'targetEntity' => ItemAttribute::class,
        ]);
        $metadata->mapManyToMany([
            'fieldName' => 'groups',
            'mappedBy' => 'items',
            'targetEntity' => ItemGroup::class,
        ]);
    }

    private int $id;
    private string $sku;
    private string $type;
    private string $name;
    private string $description;
    private int $shopId;
    private bool $isFree;
    private bool $isEnabled;
    private bool $isDeleted;
    private Collection $prices;
    private Collection $media;
    private Collection $attributes;
    private Collection $groups;
}
