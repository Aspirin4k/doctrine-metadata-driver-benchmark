<?php

namespace App\Generator;

use App\Annotation\EmptyCache;
use Doctrine\DBAL\Platforms\MySQL80Platform;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    public static function create(): EntityManagerInterface
    {
        $config = Setup::createConfiguration(
            false,
            __DIR__ . '/../Proxy',
            new EmptyCache()
        );
        $config->setMetadataDriverImpl(
            new AnnotationDriver(
                new StaticAnnotationReader('App\\Generator\\Annotation'),
                [__DIR__ . '/../Annotation/Entity']
            )
        );

        $connection = [
            'driver' => 'pdo_mysql',
            'platform' => new MySQL80Platform(),
        ];

        return EntityManager::create($connection, $config);
    }
}
