<?php

use App\Include\Entity\ItemAttribute;
use App\Include\Entity\ItemGroup;
use App\Include\Entity\ItemMedia;
use App\Include\Entity\ItemPrice;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * @var ClassMetadata $metadata
 */

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
