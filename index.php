<?php

use App\Annotation\EntityManagerFactory as AnnotationEntityManagerFactory;
use App\ApcuCache\EntityManagerFactory as ApcuEntityManagerFactory;
use App\Attribute\EntityManagerFactory as AttributeEntityManagerFactory;
use App\Generator\EntityManagerFactory as GeneratorEntityManagerFactory;
use App\Include\EntityManagerFactory as IncludeEntityManagerFactory;
use App\RedisCache\EntityManagerFactory as RedisEntityManagerFactory;
use App\Static\EntityManagerFactory as StaticEntityManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

$mode = $_GET['mode'] ?? $argv[1] ?? 'annotation';
$entityManager = match ($mode) {
    'annotation' => AnnotationEntityManagerFactory::create(),
    'attribute' => AttributeEntityManagerFactory::create(),
    'static' => StaticEntityManagerFactory::create(),
    'generator' => GeneratorEntityManagerFactory::create(),
    'include' => IncludeEntityManagerFactory::create(),
    'redis' => RedisEntityManagerFactory::create(),
    'apcu' => ApcuEntityManagerFactory::create(),
};

$metadata = $entityManager->getMetadataFactory()->getAllMetadata();
//echo json_encode($metadata, JSON_PRETTY_PRINT);
