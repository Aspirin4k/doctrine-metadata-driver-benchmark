<?php

use App\Include\Entity\Item;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * @var ClassMetadata $metadata
 */

$metadata->setPrimaryTable([
    'table' => 'item_media',
]);
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);

$metadata->mapField([
    'fieldName' => 'id',
    'type' => 'integer',
    'id' => true,
]);
$metadata->mapManyToOne([
    'fieldName' => 'item',
    'joinColumns' => [
        [
            'name' => 'item_id',
            'referencedColumnName' => 'id',
        ],
    ],
    'inversedBy' => 'media',
    'targetEntity' => Item::class,
]);
$metadata->mapField([
    'fieldName' => 'type',
    'type' => 'string',
]);
$metadata->mapField([
    'fieldName' => 'url',
    'type' => 'string',
]);
