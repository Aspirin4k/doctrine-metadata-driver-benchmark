<?php

use App\Include\Entity\Item;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * @var ClassMetadata $metadata
 */

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
